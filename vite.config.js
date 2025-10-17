import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
        "resources/scss/admin/app.scss", "resources/js/admin/app.js",
        "resources/scss/web/app.scss", "resources/js/web/app.js",
      ],
      refresh: true,
    }),
  ],
  resolve: {
    alias: {
      '@': '/resources/js',
      '@web': '/resources/js/web',
      '@admin': '/resources/js/admin',
      '@scss': '/resources/scss'
    }
  },
  server: {
    proxy: {
      // Proxy HLS streams from RTMP server
      '/hls': {
        target: 'http://localhost:8888',
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/hls/, '/live')
      },
      // Proxy RTMP API calls
      '/rtmp-api': {
        target: 'http://localhost:8888',
        changeOrigin: true,
        rewrite: (path) => path.replace(/^\/rtmp-api/, '/api')
      }
    }
  }
});
