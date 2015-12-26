module.exports = function(grunt) {

  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');

    grunt.initConfig({
      less: {
        style: {
          options: { cleancss: true },
          src: 'style.less',
          dest: 'style.css'
        }
      },
      watch: {
        less: {
          files: ["less/main.less"],
          tasks: ["less"]
        }
       }
    });
    grunt.registerTask("default", ["less", "watch"]);
};
