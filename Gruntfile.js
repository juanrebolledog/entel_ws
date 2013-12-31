module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),
    watch: {
      css: {
        files: 'public/scss/*.scss',
        tasks: ['compass:dev']
      }
    },
    compass: {
      dev: {
        options: {
          sassDir: 'public/scss',
          cssDir: 'public/css',
          trace: true
        }
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');

  grunt.registerTask('default', ['watch']);

};
