import { defineConfig } from 'vite';
import path from 'path';
import vue from '@vitejs/plugin-vue2';

export default defineConfig({
    plugins: [
      vue(),
    ],
    build: {
      minify: true,
      manifest: false,
      rollupOptions: {
        input: {
        'admin': path.resolve(__dirname, 'src/admin/admin.js'),
        'wffmain': path.resolve(__dirname, 'src/front/main.js'),
        'front': path.resolve(__dirname, 'src/front/front.css'),
        },

          output:{
            dir: 'assets',
            watch: true,
            entryFileNames: '[name].js',
            assetFileNames: '[name].[ext]',
            manualChunks: undefined,
          },

      }
    }
  })