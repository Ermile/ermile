module.exports = function(grunt) {
  grunt.initConfig({
    uglify: {
      scripts: {
        options: {
          sourceMap: true,
          mangle: false
        },
        files: {
          'js/common.js': [
          'js/src/libs/jquery.js', 'js/src/libs/localstorage.js',
          'js/src/libs/modal.js', 'js/src/tools/router.js',
          'js/src/libs/underscore.js', 'js/src/libs/utils.js',
          'js/src/tools/navigate.js', 'js/src/tools/contextmenu.js',
          'js/src/tools/notification.js',
          'js/src/tools/forms.js', 'js/src/main.js'
            ],

          'js/datepicker.js': [
            'js/src/tools/schedule.js',
            'js/src/libs/date.js', 'js/src/libs/datepicker.js',
            'js/src/libs/clockpicker.js'
            ],

          'js/filemanager.js': 'js/src/tools/filemanager.js',
          'js/mv.js': [
            'js/src/tools/model.js', 'js/src/tools/view.js',
            'js/src/tools/collections.js'
            ]
        }
      },
      tests: {
        files: {
          'tests/libs.js': [
          'js/src/libs/jquery.js',
          'js/src/libs/date.js', 'js/src/libs/datepicker.js',
          'js/src/libs/clockpicker.js',
          'js/src/libs/underscore.js',
          'js/src/localstorage.js', 'js/src/navigate.js',
          'js/src/filemanager.js', 'js/src/schedule.js'
          ]
        }
      }
    },
    less: {
      css: {
        options: {
          cleancss: true
        },
        files: {
          'css/main.css': ['css/main.less']
        }
      }
    },
    autoprefixer: {
      options: {
        browsers: ['Firefox ESR', 'Chrome > 30']
      },
      'css/main.css': 'css/main.css'
    },
    htmlmin: {
      html: {
        files: {
          'dist/index.html': 'index.html',
          'dist/file.html': 'file.html'
        }
      }
    },
    copy: {
      ermile: {
        files: [
          {
            expand: true,
            src: ['js/*.js', 'js/*.js.map'],
            dest: '../../../ermile/public_html/static/js/',
            flatten: true
          }
        ]
      }
    },
    open: {
      test: {
        path: 'http://station.dev/mahdi/tests'
      }
    },
    watch: {
      scripts: {
        files: ['js/src/*.js', 'js/src/tools/*.js', 'js/src/libs/*.js'],
        tasks: ['uglify:scripts', 'copy:ermile']
      },
      less: {
        files: ['css/**'],
        tasks: ['less', 'autoprefixer']
      },
/*      html: {
        files: ['*.html'],
        tasks: ['htmlmin']
      },*/
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-open');

  grunt.registerTask('test', ['uglify:tests', 'open']);
  grunt.registerTask('default', ['uglify', 'less', 'autoprefixer', 'copy']);
}