# Live Streaming & DVR Configuration

本文档说明如何配置和使用直播与 DVR 回放功能。

## 系统架构

- **SRS Media Server**: RTMP 推流服务器 + HLS/FLV 播放
- **Python DVR Uploader**: 自动上传录制文件到 DigitalOcean Spaces
- **Laravel API**: 处理 SRS callbacks 和 DVR webhooks
- **flv.js**: 浏览器端 FLV 播放

## 环境变量配置

在 `.env` 文件中添加以下配置：

```env
# Streaming Configuration
STREAMING_FLV_ENDPOINT=http://localhost:8080
STREAMING_HLS_ENDPOINT=http://localhost:8080
STREAMING_RTMP_SERVER=rtmp://localhost:1935

# DVR Webhook Configuration
DVR_WEBHOOK_SECRET=your-secret-key-here
```

### 2. 配置说明

- **STREAMING_FLV_ENDPOINT**: FLV 流媒体播放地址（默认 `http://localhost:8080`）
- **STREAMING_HLS_ENDPOINT**: HLS 流媒体播放地址（默认 `http://localhost:8080`）
- **STREAMING_RTMP_SERVER**: RTMP 推流服务器地址，用于 OBS 推流（默认 `rtmp://localhost:1935`）

### 3. 生产环境配置示例

```env
# Production Streaming Configuration
STREAMING_FLV_ENDPOINT=https://stream.yourdomain.com
STREAMING_HLS_ENDPOINT=https://stream.yourdomain.com
STREAMING_RTMP_SERVER=rtmp://stream.yourdomain.com:1935
```

## Docker 容器设置

项目使用 Docker Compose 管理 SRS 和 DVR Uploader 服务。

### 1. 启动服务

```powershell
# 进入 rtmp-server 目录并启动 Docker 容器
docker-compose up -d
```

### 2. Docker Compose 配置

`docker-compose.yml` 包含两个服务：
- **srs**: SRS Media Server (端口 1935/8080/1985)
- **dvr-uploader**: Python 自动上传服务

### 3. SRS 配置文件

`srs.conf` 已配置：
- **RTMP**: 端口 1935（推流）
- **HTTP-FLV**: 端口 8080（播放）
- **HTTP API**: 端口 1985（管理）
- **DVR 录制**: 自动录制到 `/recordings` 目录
- **HTTP Callbacks**: 推流事件回调到 Laravel API

### 4. SRS HTTP Callbacks

SRS 在推流开始/结束时会调用 Laravel API：
- **on_publish**: `http://tsport-new.localhost/api/srs/callback`
- **on_unpublish**: `http://tsport-new.localhost/api/srs/callback`

Laravel 会自动更新 `live_match` 表的 `obs_status`。

### 5. 验证服务

```powershell
# 检查容器状态
docker-compose ps

# 查看 SRS 版本
curl.exe http://localhost:1985/api/v1/versions

# 查看 SRS 日志
docker logs srs-server
```

## OBS 推流配置

### 1. OBS 设置

在管理后台创建或编辑直播比赛时：
1. 系统会自动生成 `obs_stream_key`（格式：`stream_{id}_{hash}`，例如：`stream_9_68fa0d1b3a112`）
2. 在 OBS 中配置：
   - **服务器**: `rtmp://localhost:1935/live`
   - **串流密钥**: 使用系统生成的 `obs_stream_key`

### 2. 推流地址格式

```
rtmp://localhost:1935/live/{obs_stream_key}
```

例如：
- `rtmp://localhost:1935/live/stream_9_68fa0d1b3a112`

### 3. 重要提示

⚠️ **文件编码问题**：如果 OBS 推流失败并提示 "Failed to connect"，检查 Laravel 路由文件是否有 UTF-8 BOM。

**解决方法（PowerShell）**：
```powershell
# 移除 BOM
$content = Get-Content "routes/api/streams.php" -Raw
$utf8NoBom = New-Object System.Text.UTF8Encoding $false
[System.IO.File]::WriteAllText("routes/api/streams.php", $content, $utf8NoBom)
```

## 直播流程

### 1. 管理员操作

1. 在后台创建直播比赛
2. 设置比赛基本信息和封面图片
3. 系统自动生成 `obs_stream_key`（例如：`stream_9_68fa0d1b3a112`）
4. 使用 OBS 推流到 `rtmp://localhost:1935/live/{obs_stream_key}`
5. SRS 自动触发 HTTP callback，更新 `obs_status` 为 `2`（Live）

### 2. 观众观看

1. 访问直播页面：`/live/{id}`（`id` 是 `live_match.id`）
2. **未直播状态** (`obs_status=0`): 显示 "Stream Offline"
3. **直播中** (`obs_status=2`): 自动播放 HLS 流媒体
4. **直播结束后有 DVR**: 自动播放 FLV 回放

### 3. 状态说明（obs_status）

- **0**: Offline - 离线/已结束
- **1**: Preparing - 准备中（未使用）
- **2**: Live - 直播中

### 4. 自动 DVR 录制

- SRS 自动录制所有直播到 `/recordings` 目录
- Python Uploader 监听目录，自动上传到 DigitalOcean Spaces
- 上传完成后发送 Webhook 到 Laravel
- Laravel 保存 DVR URL 到 `live_match.dvr_recordings` (JSON 字段)

## 播放器技术栈

### 直播播放
- **HLS.js**: HLS 流媒体播放（直播）
- **HTTP-HLS**: 主要直播协议（兼容性好）
- **Native HTML5**: 浏览器原生 video 标签

### DVR 回放播放
- **flv.js**: FLV 文件播放（回放）
- **HTTP-FLV**: 从 DigitalOcean Spaces CDN 拉取
- **Native Controls**: 使用浏览器原生控制条

## 前端集成

### 直播页面逻辑（live.blade.php）

```blade
@if ($match['obs_status'] == 2)
    <!-- 直播中：播放 HLS -->
    <video id="live-player" controls>
        <source src="http://localhost:8080/live/{{ $match['obs_stream_key'] }}/index.m3u8" type="application/x-mpegURL">
    </video>
@elseif ($match['obs_status'] == 0 && !empty($match['dvr_recordings']))
    <!-- 离线但有 DVR：播放回放 -->
    <video id="replay-player" controls 
        data-recordings="{{ json_encode($match['dvr_recordings']) }}">
    </video>
@else
    <!-- 无直播无回放 -->
    <div class="stream-offline">Stream Offline</div>
@endif
```

### DVR 回放 JavaScript

```javascript
// 使用 flv.js 播放 FLV 回放
if (flvjs.isSupported()) {
    const recordings = JSON.parse(videoElement.dataset.recordings);
    const firstRecording = recordings[0];
    
    flvPlayer = flvjs.createPlayer({
        type: 'flv',
        url: firstRecording.file_url // DigitalOcean Spaces CDN URL
    });
    
    flvPlayer.attachMediaElement(videoElement);
    flvPlayer.load();
}
```

## DVR 自动上传配置

### 1. Python Uploader 环境变量

在 `rtmp-server/.env` 中配置：

```env
# DigitalOcean Spaces
SPACES_REGION=sgp1
SPACES_BUCKET=srs-tsport
SPACES_ACCESS_KEY=your_access_key
SPACES_SECRET_KEY=your_secret_key
SPACES_ENDPOINT=https://sgp1.digitaloceanspaces.com

# CDN (optional)
SPACES_CDN_ENABLED=true
SPACES_CDN_URL=https://srs-tsport.sgp1.cdn.digitaloceanspaces.com

# Webhook
WEBHOOK_ENABLED=true
WEBHOOK_URL=http://tsport-new.localhost/api/dvr/upload-complete
WEBHOOK_SECRET=your-secret-key-here

# Cleanup
DELETE_AFTER_UPLOAD=false
```

### 2. Laravel Webhook Endpoint

- **URL**: `/api/dvr/upload-complete`
- **Controller**: `App\Http\Controllers\Api\WebhookController@dvrUploadComplete`
- **Authentication**: Webhook secret validation
- **功能**: 保存 DVR 录制信息到 `live_match.dvr_recordings`

### 3. 数据库结构

```sql
-- live_match 表
dvr_recordings JSON NULL,  -- 存储所有录制文件信息
dvr_last_uploaded_at TIMESTAMP NULL  -- 最后上传时间
```

DVR 录制数据格式：
```json
[
  {
    "filename": "1761302803112.flv",
    "file_url": "https://srs-tsport.sgp1.cdn.digitaloceanspaces.com/dvr/live/stream_8_68fa0d1b398c8/1761302803112.flv",
    "file_size": 3261815,
    "recording_started_at": "2025-10-24 18:46:43",
    "uploaded_at": "2025-10-24T12:05:36.578531Z",
    "sequence": 1
  }
]
```

## 故障排查

### 1. OBS 无法推流

**症状**: "Failed to connect" 或 "Could not access the specified channel or stream key"

**解决方法**:
```powershell
# 1. 检查 SRS 是否运行
docker ps

# 2. 查看 SRS 日志
docker logs srs-server --tail 50

# 3. 检查端口
netstat -ano | Select-String ":1935"

# 4. 测试 API callback
curl.exe -X POST http://tsport-new.localhost/api/srs/callback -H "Content-Type: application/json" -d '{\"action\":\"on_publish\",\"stream\":\"test_stream\"}'

# 5. 检查 PHP 文件 BOM（常见问题）
# 如果响应中有乱码，移除 routes/api/streams.php 的 BOM
```

### 2. DVR 未上传到 Spaces

**症状**: 录制文件存在但未上传

**解决方法**:
```powershell
# 1. 检查 dvr-uploader 容器
docker logs dvr-uploader --tail 50

# 2. 检查环境变量
docker exec dvr-uploader env | Select-String "SPACES"

# 3. 手动测试上传
docker exec dvr-uploader ls -la /recordings/live/

# 4. 重启 uploader
docker-compose restart dvr-uploader
```

### 3. Webhook 未触发

**症状**: 文件上传了但数据库无记录

**解决方法**:
```powershell
# 1. 查看 Laravel 日志
Get-Content storage/logs/laravel.log -Tail 50 -Wait

# 2. 测试 webhook
curl.exe -X POST http://tsport-new.localhost/api/dvr/upload-complete -H "Content-Type: application/json" -H "X-Webhook-Secret: your-secret-key" -d '{\"stream_name\":\"stream_8_68fa0d1b398c8\",\"filename\":\"test.flv\",\"file_url\":\"https://test.com/test.flv\",\"file_size\":1000,\"upload_time\":\"2025-10-24T12:00:00Z\",\"stream_app\":\"live\",\"timestamp\":\"1234567890\"}'

# 3. 检查 webhook secret 是否匹配
# rtmp-server/.env 和 tsport-new/.env 的 WEBHOOK_SECRET 要一致
```

### 4. DVR 回放无法播放

**症状**: 页面显示回放但播放器报错

**解决方法**:
```powershell
# 1. 检查 CORS 配置
# DigitalOcean Spaces 需要配置 CORS

# 2. 测试文件是否可访问
curl.exe -I https://srs-tsport.sgp1.cdn.digitaloceanspaces.com/dvr/live/stream_X/file.flv

# 3. 检查文件 ACL 权限
# 确保上传时设置了 public-read
# scripts/upload_to_spaces.py 中应该是:
# ExtraArgs={'ACL': 'public-read'}

# 4. 查看浏览器控制台
# F12 -> Console 查看详细错误
```

## 性能优化

### 1. CDN 配置

生产环境建议使用 CDN 加速：

```env
STREAMING_FLV_ENDPOINT=https://cdn.yourdomain.com
STREAMING_HLS_ENDPOINT=https://cdn.yourdomain.com
```

### 2. 负载均衡

多台 SRS 服务器可以通过 Nginx 进行负载均衡：

```nginx
upstream srs_cluster {
    server srs1.yourdomain.com:8080;
    server srs2.yourdomain.com:8080;
    server srs3.yourdomain.com:8080;
}

server {
    listen 80;
    server_name stream.yourdomain.com;
    
    location /live/ {
        proxy_pass http://srs_cluster;
    }
}
```

## API 路由

### Laravel API Routes

```php
// SRS Callback
POST /api/srs/callback          # StreamController@srsCallback
POST /api/streams/callback      # StreamController@srsCallback (alternative)

// DVR Webhook
POST /api/dvr/upload-complete   # WebhookController@dvrUploadComplete

// Streaming Info
GET /api/streams/{streamKey}    # StreamController@show
GET /api/dvr/recordings/{id}    # StreamController@getDvrRecordings
```

## 相关文件

### Laravel
- `config/streaming.php` - Streaming 配置文件
- `routes/api/streams.php` - 流媒体 API 路由
- `routes/api/webhooks.php` - Webhook API 路由
- `app/Http/Controllers/Api/StreamController.php` - 流控制器
- `app/Http/Controllers/Api/WebhookController.php` - Webhook 控制器
- `app/Models/LiveMatch.php` - 直播比赛模型
- `resources/views/web/live.blade.php` - 直播页面模板

### Docker & Scripts
- `rtmp-server/docker-compose.yml` - Docker 编排
- `rtmp-server/srs.conf` - SRS 配置
- `rtmp-server/scripts/upload_to_spaces.py` - Python 上传脚本
- `rtmp-server/scripts/requirements.txt` - Python 依赖
- `rtmp-server/.env` - Docker 环境变量

## 总结

完整的直播+DVR流程：

1. **推流**: OBS → SRS (RTMP) → SRS 触发 on_publish callback → Laravel 更新 `obs_status=2`
2. **直播**: 浏览器 → HLS.js → SRS (HLS) → 实时观看
3. **录制**: SRS DVR → 录制 FLV 到 `/recordings`
4. **上传**: Python Uploader → DigitalOcean Spaces → 发送 Webhook
5. **保存**: Laravel Webhook → 保存到 `dvr_recordings` JSON 字段
6. **回放**: 浏览器 → flv.js → DigitalOcean Spaces CDN → DVR 回放
