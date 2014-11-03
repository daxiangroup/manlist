var gulp = require('gulp'),
    sass = require('gulp-sass'),
    uglify = require('gulp-uglify'),
    rename = require('gulp-rename');

gulp.task('styles', function() {
    gulp.src('./public/css/*.scss')
        .pipe(sass({ style: 'compressed' }))
        .pipe(gulp.dest('./public/css'));
});

gulp.task('scripts', function() {
    gulp.src('./public/js/manlist.js')
        .pipe(rename({ suffix: '.min' }))
        .pipe(uglify())
        .pipe(gulp.dest('./public/js'));
});

gulp.task('watch', function() {
    gulp.watch('./public/css/*.scss', ['styles']);

    gulp.watch('./public/js/manlist.js', ['scripts']);
});
