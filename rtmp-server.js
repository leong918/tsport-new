const NodeMediaServer = require('node-media-server');

const config = {
  rtmp: {
    port: 1935,
    chunk_size: 60000,
    gop_cache: true,
    ping: 30,
    ping_timeout: 60,
    // Allow publishing from any source
    allow_origin: '*'
  },
  http: {
    port: 8888,
    mediaroot: './public/streams',
    allow_origin: '*',
    // Enable CORS for web access
    api: true
  },
  // Enable HLS for web playback
  hls: {
    mediaroot: './public/streams',
    segment_time: 4,
    max_age: 60
  }
};

const nms = new NodeMediaServer(config);

// Event handlers for debugging and monitoring
nms.on('preConnect', (id, args) => {
  console.log('📡 [RTMP] Connection attempt:', id);
});

nms.on('postConnect', (id, args) => {
  console.log('✅ [RTMP] Connected:', id);
});

nms.on('doneConnect', (id, args) => {
  console.log('❌ [RTMP] Disconnected:', id);
});

nms.on('prePublish', (id, StreamPath, args) => {
  console.log('🎥 [STREAM] Publishing started:', StreamPath);
  
  // Extract stream key for validation
  const streamKey = StreamPath.split('/').pop();
  console.log('🔑 Stream Key:', streamKey);
  
  // Here you could validate the stream key against your database
  // For development, we'll allow all streams
  console.log('✅ [AUTH] Stream authorized');
});

nms.on('postPublish', (id, StreamPath, args) => {
  console.log('🟢 [STREAM] Live:', StreamPath);
  
  // Notify your Laravel app that stream started
  const streamKey = StreamPath.split('/').pop();
  notifyStreamStatus(streamKey, 'live');
});

nms.on('donePublish', (id, StreamPath, args) => {
  console.log('🔴 [STREAM] Ended:', StreamPath);
  
  // Notify your Laravel app that stream ended
  const streamKey = StreamPath.split('/').pop();
  notifyStreamStatus(streamKey, 'ended');
});

// Function to notify Laravel app about stream status
async function notifyStreamStatus(streamKey, status) {
  try {
    // Use environment variable or default to localhost
    const appUrl = process.env.APP_URL || 'http://tsport-new.localhost';
    const apiUrl = `${appUrl}/api/streams/status`;
    
    const response = await fetch(apiUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
      },
      body: JSON.stringify({
        stream_key: streamKey,
        status: status,
        timestamp: new Date().toISOString()
      })
    });
    
    if (response.ok) {
      console.log(`✅ Notified Laravel: ${streamKey} -> ${status}`);
    } else {
      console.log(`⚠️  Failed to notify Laravel: ${response.status}`);
    }
  } catch (error) {
    console.log('⚠️  Laravel notification error:', error.message);
  }
}

// Start the server
nms.run();

console.log('🚀 TSport RTMP Server Started!');
console.log('');
console.log('📡 RTMP Endpoint: rtmp://localhost:1935/live');
console.log('🌐 HTTP API: http://localhost:8888/api');
console.log('📺 HLS Streams: http://localhost:8888/live/{stream_key}/index.m3u8');
console.log('');
console.log('🎬 OBS Studio Configuration:');
console.log('   Server URL: rtmp://localhost:1935/live');
console.log('   Stream Key: Get from your admin panel');
console.log('');
console.log('🔧 Admin Panel: http://localhost:8000/admin/live-match');

// Graceful shutdown
process.on('SIGINT', () => {
  console.log('\n🛑 Shutting down RTMP server...');
  nms.stop();
  process.exit(0);
});

process.on('SIGTERM', () => {
  console.log('\n🛑 Shutting down RTMP server...');
  nms.stop();
  process.exit(0);
});
