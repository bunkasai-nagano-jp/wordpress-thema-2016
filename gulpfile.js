'use strict';

var gulp = require('gulp');
var less = require('gulp-less');
var postcss      = require('gulp-postcss');
var cssnano      = require('cssnano');
var rename       = require('gulp-rename');
var autoprefixer = require('autoprefixer');
var rimraf       = require('rimraf');
var runSequence  = require('run-sequence');
var plumber      = require('gulp-plumber');

var dir = {
    src: {
        css: 'src/less',
        packages: 'node_modules'
    },
    dist: {
        css: './',
        packages: 'src/packages',
        vendor: 'assets/vendor'
    }
}

gulp.task('font-awesome', function() {
    return gulp.src(dir.src.packages + '/font-awesome/**', {base: 'node_modules'})
        .pipe(gulp.dest(dir.dist.vendor));
});

/**
 * Remove directory for copied node modules
 */
gulp.task('remove-packages-dir', function(cb) {
    rimraf(dir.dist.packages, cb);
});

/**
 * Build CSS
 */
gulp.task('css', function() {
    return lessCompile(dir.src.css + '/*.less', dir.dist.css)
        .on('end', function() {
            return lessCompile(dir.src.vendor + '/*.less', dir.dist.vendor);
        });
});

function lessCompile(src, dest) {
    return gulp.src(src)
        .pipe(plumber())
        .pipe(less())
        .pipe(postcss([
            autoprefixer({
                browsers: ['last 2 versions'],
                cascade: false
            })
        ]))
        .pipe(gulp.dest(dest))
        .pipe(postcss([
            cssnano({
                'zindex': false
            })
        ]))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(dest))
}

gulp.task('build', ['font-awesome'], function() {
    return runSequence('css');
});

gulp.task('default', ['build'], function() {
    gulp.watch([dir.src.css + '/*.less'], ['css']);
});