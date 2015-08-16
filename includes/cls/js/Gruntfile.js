var fs = require('fs')
module.exports = function(grunt) {
  grunt.initConfig({
    coffee: {
      compile: {
        files: {
          'js/src/saloos/saloos.js': 'js/src/saloos/*.coffee'
        }
      },
    },
    uglify: {
      options: {
        sourceMap: false,
        mangle: false
      },
      saloos: {
        options: {
          // mangle: true
        },
        files: {
          'js/src/saloos/saloos.min': [
            'js/src/saloos/*.js'
            ]
        }
      },
      common: {
        files: {
          'js/common.js': [
            'js/src/libs/jquery.js', 'js/src/libs/localstorage.js',
            'js/src/libs/modal.js', 'js/src/tools/router.js',
            'js/src/libs/underscore.js', 'js/src/libs/utils.js',
            'js/src/tools/navigate.js',
            'js/src/tools/notification.js',
            'js/src/tools/forms.js', 'js/src/main.js'
            ],
        }
      },
      datepicker: {
        files: {
          'js/datepicker.js': [
            'js/src/tools/schedule.js',
            'js/src/libs/date.js', 'js/src/libs/datepicker.js',
            'js/src/libs/clockpicker.js'
            ],
        }
      },
      filemanager: {
        files: {
          'js/filemanager.js': [
            'js/src/libs/socket.io.js',
            'js/src/tools/filemanager.js',
            'js/src/tools/contextmenu.js',
            'js/src/libs/cortex.js', 'js/src/libs/react-addons.js',
            'views/build.js'
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
    react: {
      views: {
        files: {
          'views/build.js': 'views/**/*.jsx'
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
            src: ['js/*.js'],
            dest: '../../../public_html/static/js/',
            flatten: true
          }
        ]
      },
      talambar: {
        files: [
          {
            expand: true,
            src: ['js/filemanager.js'],
            dest: '../../../../talambar/public_html/static/js/',
            flatten: true
          },
          {
            expand: true,
            src: 'js/src/subs/files-folders.js',
            dest: '../../../../talambar/public_html/static/js/',
            flatten: true
          }
        ]
      },

      all: {
        files: [
          { 
            expand: true, flatten: true, src: ['js/common.js'], 
            dest: '../../../../ermile/public_html/static/js/'
          },
          { 
            expand: true, flatten: true, src: ['js/common.js'], 
            dest: '../../../../saloos-project/public_html/static/js/'
          },
          { 
            expand: true, flatten: true, src: ['js/saloos.js'], 
            dest: '../../../../amon/public_html/static/js/'
          },
          { 
            expand: true, flatten: true, src: ['js/common.js'], 
            dest: '../../../../amon/public_html/static/js/'
          },
          { 
            expand: true, flatten: true, src: ['js/common.js'], 
            dest: '../../../../city/public_html/static/js/'
          },
          { 
            expand: true, flatten: true, src: ['js/common.js'], 
            dest: '../../../../quranhadith/public_html/static/js/'
          },
        ]
      }
    },
    watch: {
      views: {
        files: ['views/*'],
        tasks: ['react', 'uglify:filemanager']
      },
      coffee: {
        files: ['js/src/saloos/*.coffee'],
        tasks: ['coffee:compile']
      },
      saloos: {
        files: ['js/src/saloos/saloos.min'],
        tasks: ['ermile_cp']
      },
      ermile_cp: {
        files: ['js/src/saloos/*.js'],
        tasks: ['uglify:saloos']
      },
      common: {
        files: ['js/src/libs/jquery.js', 'js/src/libs/localstorage.js',
            'js/src/libs/modal.js', 'js/src/tools/router.js',
            'js/src/libs/underscore.js', 'js/src/libs/utils.js',
            'js/src/tools/navigate.js',
            'js/src/tools/notification.js',
            'js/src/tools/forms.js', 'js/src/main.js'],
        tasks: ['uglify:common']
      },
      datepicker: {
        files: [
            'js/src/tools/schedule.js',
            'js/src/libs/date.js', 'js/src/libs/datepicker.js',
            'js/src/libs/clockpicker.js'
            ],
        tasks: ['uglify:datepicker']
      },
      filemanager: {
        files: ['js/src/tools/filemanager.js', 'js/src/tools/contextmenu.js'],
        tasks: ['uglify:filemanager']
      },
      mv: {
        files:  ['js/src/libs/react-addons.js', 'js/src/libs/cortex.js'],
        tasks: ['uglify:mv']
      },
      scripts: {
        files: ['js/*.js', 'js/src/libs/*.js', 'js/src/subs/*.js'],
        tasks: ['copy:ermile', 'copy:talambar', 'copy:all']
      },
      less: {
        files: ['css/**'],
        tasks: ['less', 'autoprefixer']
      },
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-htmlmin');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-open');
  grunt.loadNpmTasks('grunt-react');
  grunt.loadNpmTasks('grunt-contrib-coffee');
  grunt.task.registerTask('ermile_cp', 'A sample task that logs stuff.', function(arg1, arg2) {
    var projects = Array('ermile');
    for (var i = 0; i< projects.length; i++){
      var file_name = '../../../../'+projects[i]+'/public_html/static/js/cp/cp.js';
        if(fs.existsSync(file_name)){
          file = fs.readFileSync(file_name).toString()
          saloos = fs.readFileSync('js/src/saloos/saloos.min').toString()
          file = file.replace(/\/\*\*\*cpjs\*\*\*\/([.\r\n\s\S]+)\/\*\*\*cpjs\*\*\*\//gmi, '/***cpjs***/'+saloos+'/***cpjs***/')
          fs.writeFileSync(file_name, file)
          console.log("ermile saved true on cp's")
        }
    }
  });
  grunt.registerTask('test', ['uglify:tests']);
  grunt.registerTask('default', ['react', 'uglify', 'less', 'autoprefixer', 'copy', 'coffee', 'ermile_cp', 'watch']);
}