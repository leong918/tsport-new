# Live Streaming Configuration

本文档说明如何配置和使用直播功能。

## 配置 Streaming 服务器

### 1. 环境变量配置

在 `.env` 文件中添加以下配置：

```env
# Streaming Configuration
STREAMING_FLV_ENDPOINT=http://localhost:8080
STREAMING_HLS_ENDPOINT=http://localhost:8080
STREAMING_RTMP_SERVER=rtmp://localhost:1935
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

## 使用 SRS (Simple Realtime Server)

### 1. 安装 SRS

```bash
# Docker 方式启动 SRS
docker run -d \
  --name srs \
  -p 1935:1935 \
  -p 8080:8080 \
  -p 1985:1985 \
  ossrs/srs:5
```

### 2. SRS 配置文件

基本的 SRS 配置 (`srs.conf`):

```nginx
listen              1935;
max_connections     1000;

http_server {
    enabled         on;
    listen          8080;
    dir             ./objs/nginx/html;
}

http_api {
    enabled         on;
    listen          1985;
}

vhost __defaultVhost__ {
    hls {
        enabled         on;
        hls_path        ./objs/nginx/html;
        hls_fragment    10;
        hls_window      60;
    }
    
    http_remux {
        enabled     on;
        mount       [vhost]/[app]/[stream].flv;
    }
}
```

### 3. 验证 SRS 服务

访问 `http://localhost:1985/api/v1/versions` 应该返回 SRS 版本信息。

## OBS 推流配置

### 1. OBS 设置

在管理后台创建或编辑直播比赛时：
1. 系统会自动生成 `Stream Key`（例如：`match123`）
2. 在 OBS 中配置：
   - **服务器**: `rtmp://localhost:1935/live`（使用 `.env` 中的 `STREAMING_RTMP_SERVER`）
   - **串流密钥**: 使用系统生成的 Stream Key

### 2. 推流地址格式

```
rtmp://{STREAMING_RTMP_SERVER}/live/{stream_key}
```

例如：
- 开发环境: `rtmp://localhost:1935/live/match123`
- 生产环境: `rtmp://stream.yourdomain.com:1935/live/match123`

## 直播流程

### 1. 管理员操作

1. 在后台创建直播比赛
2. 设置比赛基本信息和封面图片
3. 系统生成 Stream Key（显示在比赛详情页）
4. 使用 OBS 推流到 `rtmp://{server}/live/{stream_key}`
5. 点击"开始直播"按钮（状态变为 `live`）

### 2. 观众观看

1. 访问直播页面
2. **未开赛状态**: 显示比赛 fixture 图片（木制相框效果）
3. **直播中**: 自动播放 FLV 流媒体
4. **已结束**: 显示比赛结束信息

### 3. 状态说明

- **upcoming** (0): 未开赛 - 显示 fixture 图片
- **offline** (1): 未直播 - 显示提示信息
- **live** (2): 直播中 - 播放实时流媒体

## 播放器技术栈

- **Video.js**: 视频播放器框架
- **FLV.js**: FLV 流媒体支持
- **HTTP-FLV**: 主要使用的直播协议（低延迟）
- **HLS**: 备用播放协议（更好的兼容性）

## 前端集成

播放器会自动从 Laravel config 读取配置：

```javascript
// 在 live.blade.php 中注入配置
window.streamingConfig = {
    flvEndpoint: '{{ config('streaming.flv_endpoint') }}',
    hlsEndpoint: '{{ config('streaming.hls_endpoint') }}',
    rtmpServer: '{{ config('streaming.rtmp_server') }}'
};

// 在 live.js 中使用
const flvEndpoint = window.streamingConfig?.flvEndpoint || 'http://localhost:8080';
const flvUrl = `${flvEndpoint}/live/${streamKey}.flv`;
```

## 故障排查

### 1. 无法推流

- 检查 SRS 服务是否运行：`docker ps | grep srs`
- 检查防火墙是否开放 1935 端口
- 验证 RTMP 地址是否正确

### 2. 播放器无法加载

- 检查浏览器控制台错误
- 验证 FLV endpoint 是否可访问
- 确认 stream key 是否正确

### 3. 延迟过高

- 使用 FLV 协议而非 HLS（FLV 延迟 1-3 秒，HLS 延迟 10-30 秒）
- 调整 SRS 配置中的 `hls_fragment` 参数
- 检查网络带宽

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

## 相关文件

- `config/streaming.php` - Streaming 配置文件
- `resources/views/web/live.blade.php` - 直播页面模板
- `resources/js/web/pages/live.js` - 播放器 JavaScript
- `app/Models/LiveMatch.php` - 直播比赛模型
- `app/Repositories/LiveMatchRepository.php` - 直播比赛数据仓库
