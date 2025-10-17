const NodeMediaServer = require('node-media-server');
const path = require('path');

const config = {
  logType: 3,
  rtmp: {
    port: 1936,
    chunk_size: 60000,
    gop_cache: true,
    ping: 30,
    ping_timeout: 60
  },
  http: {
    port: 8889,
    allow_origin: '*'
  }
};

const nms = new NodeMediaServer(config);

// Event handlers
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
  console.log('🎥 [STREAM] Publishing started');
  
  let streamKey = null;
  if (id && id.streamName) {
    streamKey = id.streamName;
  } else if (id && id.streamPath) {
    streamKey = id.streamPath.split('/').pop();
  }
  
  console.log('🔑 Stream Key:', streamKey);
  console.log('🏠 Stream Host:', id.streamHost);
  console.log('📱 Stream App:', id.streamApp);
  
  console.log('✅ [AUTH] Stream authorized');
});

nms.on('postPublish', (id, StreamPath, args) => {
  console.log('🟢 [STREAM] Now Live!');
  
  let streamKey = null;
  if (id && id.streamName) {
    streamKey = id.streamName;
  } else if (id && id.streamPath) {
    streamKey = id.streamPath.split('/').pop();
  }
  
  console.log('🔑 Stream Key:', streamKey);
  
  if (streamKey) {
    notifyStreamStatus(streamKey, 'live');
  } else {
    console.log('❌ Could not extract stream key');
  }
});

nms.on('donePublish', (id, StreamPath, args) => {
  console.log('🔴 [STREAM] Ended');
  
  let streamKey = null;
  if (id && id.streamName) {
    streamKey = id.streamName;
  } else if (id && id.streamPath) {
    streamKey = id.streamPath.split('/').pop();
  }
  
  console.log('🔑 Stream Key:', streamKey);
  
  if (streamKey) {
    notifyStreamStatus(streamKey, 'ended');
  } else {
    console.log('❌ Could not extract stream key');
  }
});

// Function to notify Laravel app about stream status
async function notifyStreamStatus(streamKey, status) {
  try {
    const fetch = (await import('node-fetch')).default;
    
    // Use environment variable or default to tsport-new.localhost
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
console.log('📡 RTMP Endpoint: rtmp://localhost:1936/live');
console.log('🌐 HTTP API: http://localhost:8889/api');
console.log('📺 Live Streams: http://localhost:8889/live/{stream_key}.flv');
console.log('');
console.log('🎬 OBS Studio Configuration:');
console.log('   Server URL: rtmp://localhost:1936/live');
console.log('   Stream Key: Get from your admin panel');
console.log('');
console.log('🔧 Admin Panel: http://localhost:8000/admin/live-match');

// Graceful shutdown
process.on('SIGINT', () => {
  console.log('\n🛑 Shutting down RTMP server...');
  if (nms && typeof nms.stop === 'function') {
    nms.stop();
  }
  process.exit(0);
});

process.on('SIGTERM', () => {
  console.log('\n🛑 Shutting down RTMP server...');
  if (nms && typeof nms.stop === 'function') {
    nms.stop();
  }
  process.exit(0);
});
