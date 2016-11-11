var gulp = require('gulp');
var sass = require('gulp-sass');

//task for the sass
gulp.task('sass', function(){
   gulp.src('web/public/sass/**/*.sass')
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(gulp.dest('web/public/css'))
})

//task for watch
gulp.task('watch', function(){
    gulp.watch('web/public/sass/**/*.sass', ['sass'])
})

//task for default gulp
gulp.task('default', ['sass', 'watch'])