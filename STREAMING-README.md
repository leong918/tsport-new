# TSport Live Streaming System

## 🎯 功能说明

完整的实时直播系统，支持 OBS Studio 推流和前端播放。

## 🚀 快速启动

### 开发环境 (自动启动 RTMP + Vite)
```bash
npm run dev:streaming
```

### 生产环境 (推荐)
```bash
# 完整启动 (Laravel + RTMP + Vite)
npm run streaming

# 或者分别启动
npm run rtmp:server  # RTMP 服务器
php artisan serve    # Laravel 服务器
npm run build        # 构建前端资源
```

### Ubuntu 部署 (使用 DeployBot)
```bash
# 安装依赖
npm install

# 启动 RTMP 服务器
npm run rtmp:start

# 启动 Laravel (使用 PM2 或 Supervisor)
php artisan serve --host=0.0.0.0 --port=80
```

## 📺 系统架构

- **RTMP 服务器**: `localhost:1936` - 接收 OBS 推流
- **FLV 流服务**: `localhost:8889` - 提供 FLV 流给前端
- **Laravel 服务器**: `localhost:8000` - 管理后台和前端播放
- **数据库**: MySQL - 存储直播间配置和状态

## 🎬 OBS 配置

1. **服务器设置**:
   - 服务器: `rtmp://localhost:1936/live`
   - 流密钥: 从管理后台获取

2. **推荐设置**:
   - 视频比特率: 2500 kbps
   - 音频比特率: 160 kbps
   - 分辨率: 1280x720
   - 帧率: 30 FPS

## 🛠️ 管理后台

- **访问地址**: http://127.0.0.1:8000/admin/live-match
- **功能**:
  - 创建直播间
  - 生成流密钥
  - 监控直播状态
  - 查看观看人数

## 🎥 前端播放

- **直播页面**: http://127.0.0.1:8000/live/{id}
- **支持功能**:
  - FLV.js 实时播放
  - 自动重连机制
  - 观看人数显示
  - 实时聊天功能

## 📋 API 接口

### 创建直播间
```
GET /create-stream/{streamKey}
```

### 流状态通知 (RTMP服务器调用)
```
POST /api/streams/status
```

## 🔧 技术栈

- **后端**: Laravel 10+, PHP 8+
- **前端**: Video.js + FLV.js
- **流媒体**: Node Media Server
- **数据库**: MySQL 8+
- **实时通信**: WebSocket (可选)

## 📁 关键文件

- `rtmp-server.cjs` - RTMP 服务器配置
- `routes/debug-stream.php` - 直播辅助路由
- `routes/api-streams.php` - 流状态 API
- `resources/views/web/live.blade.php` - 前端播放页面
- `app/Repositories/LiveMatchRepository.php` - 直播数据操作

## 🐛 故障排除

1. **OBS 无法连接**:
   - 检查 RTMP 服务器是否启动
   - 确认端口 1936 未被占用

2. **前端无法播放**:
   - 检查流密钥是否正确
   - 确认 Laravel 服务器运行正常
   - 查看浏览器控制台错误

3. **端口冲突**:
   ```bash
   # Linux/Ubuntu 查看端口占用
   sudo lsof -i :1936
   sudo lsof -i :8889
   sudo lsof -i :8000
   
   # Windows 查看端口占用
   netstat -ano | findstr :1936
   netstat -ano | findstr :8889
   netstat -ano | findstr :8000
   ```

## 📞 支持

如遇问题，请检查：
1. Node.js 版本 >= 16
2. PHP 版本 >= 8.0
3. MySQL 服务正常运行
4. 防火墙设置允许相关端口
