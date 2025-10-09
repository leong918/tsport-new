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
  }
});
