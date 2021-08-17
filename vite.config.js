export default ({ command }) => ({
  base: command === "serve" ? "" : "/public/",
  publicDir: "fake_dir_so_nothing_gets_copied",
  build: {
    manifest: true,
    outDir: "public",
    rollupOptions: {
      input: ["resources/js/app.js", "resources/js/admin.js"],
    },
  },
  server: {
    fs: {
      allow: [".", ".."],
    },
  },
  plugins: [
    {
      name: "php",
      handleHotUpdate({ file, server }) {
        if (file.endsWith(".php")) {
          server.ws.send({
            type: "full-reload",
            path: "*",
          });
        }
      },
    },
  ],
});
