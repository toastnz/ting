/*------------------------------------------------------------------
 Imports
 ------------------------------------------------------------------*/
const fs           = require('fs');
const gulp         = require('gulp');
const chalk        = require('chalk');
const sass         = require('gulp-sass');
const gutil        = require('gulp-util');
const pixrem       = require('gulp-pixrem');
const plumber      = require('gulp-plumber');
const replace      = require('gulp-replace');
const sourcemaps   = require('gulp-sourcemaps');
const autoprefixer = require('gulp-autoprefixer');
const bulkSass     = require('gulp-sass-bulk-import');

/*------------------------------------------------------------------
 Config
 ------------------------------------------------------------------*/

const root = `${__dirname}/`;

const paths = {
    styles : {
        src : `${root}app/styles/**/*.scss`,
        dest: `${root}dist/styles/`
    },
    sprites: {
        standard: `${root}app/sprites/*@1x.png`,
        retina  : `${root}app/sprites/*@2x.png`
    },
    reg    : {
        root: new RegExp(root + 'app/', 'g'),
        dist: new RegExp(root + 'dist/', 'g')
    }
};

/*------------------------------------------------------------------
 Styles
 ------------------------------------------------------------------*/
gulp.task('styles', () => {
    return gulp.src(`${root}app/styles/style.scss`)
        .pipe(plumber(function (error) {
            gutil.log(`${chalk['yellow'](error.file.toString().replace(paths.reg.root, ''))}`);
            gutil.log(`${chalk['red'](error['messageOriginal'])}`);
            this.emit('end');
        }))
        .pipe(bulkSass())
        .pipe(sourcemaps.init())
        .pipe(sass({outputStyle: 'compressed'}))
        .pipe(autoprefixer({browsers: ['last 5 versions']}))
        .pipe(pixrem({rootValue: '10px'}))
        .pipe(sourcemaps.write('./'))
        .pipe(gulp.dest(paths.styles.dest));
});

/*------------------------------------------------------------------
 Task Declaration
 ------------------------------------------------------------------*/

gulp.task('start', function () {
    Message('start', 'green');
});

gulp.task('default', ['start', 'styles'], function () {
    gulp.watch([paths.styles.src], ['styles']).on('change', function (evt) {
        Message('scss', 'green');
        gutil.log(chalk['green'](' => ') + chalk['blue'](evt.path.replace(/^.*\/(?=[^\/]*$)/, '')) + ' was ' + chalk['green'](evt.type));
    });
});

/*------------------------------------------------------------------
 Output Messages
 ------------------------------------------------------------------*/

function Message(message, col) {
    let color = (col != undefined) ? col : 'yellow';
    gutil.log(chalk[color](Messages[message]));
}

const Messages = {
    start: ' ██████╗ ██╗   ██╗██╗ ██████╗██╗  ██╗███████╗██╗██╗    ██╗   ██╗███████╗██████╗\n           ██╔═══██╗██║   ██║██║██╔════╝██║ ██╔╝██╔════╝██║██║    ██║   ██║██╔════╝██╔══██╗\n           ██║   ██║██║   ██║██║██║     █████╔╝ ███████╗██║██║    ██║   ██║█████╗  ██████╔╝\n           ██║▄▄ ██║██║   ██║██║██║     ██╔═██╗ ╚════██║██║██║    ╚██╗ ██╔╝██╔══╝  ██╔══██╗\n           ╚██████╔╝╚██████╔╝██║╚██████╗██║  ██╗███████║██║███████╗╚████╔╝ ███████╗██║  ██║\n            ╚══▀▀═╝  ╚═════╝ ╚═╝ ╚═════╝╚═╝  ╚═╝╚══════╝╚═╝╚══════╝ ╚═══╝  ╚══════╝╚═╝  ╚═╝',
    scss : '╔═══════════════════════════╗\n           ║       Sass compiled       ║\n           ╚═══════════════════════════╝',
    js   : '╔════════════════════════╗\n           ║       JS bundled       ║\n           ╚════════════════════════╝',
    error: '╔═══════════════════════╗\n           ║ An error has occurred ║\n           ╚═══════════════════════╝',
};
