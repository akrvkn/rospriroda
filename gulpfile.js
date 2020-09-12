var gulp = require('gulp');
//var size = require('gulp-size'); //shows the size of the entire project or files
var imagemin = require('gulp-imagemin');
var pngquant = require('imagemin-pngquant');

//gulp stuff (no watch breaking on errors)
var plumber = require('gulp-plumber');

// images
gulp.task('compress_img', function() {
    gulp.src('src/**')
        .pipe(imagemin({
                progressive: true,
                optimizationLevel: 1,
                svgoPlugins: [
                    {removeViewBox: false},
                    {removeDoctype: true},
                    {removeComments: true},
                    {cleanupNumericValues:
                        {floatPrecision: 2}
                    },
                    {convertColors: {
                        names2hex: false,
                        rgb2hex: false
                    }
                    }],
                use: [pngquant()]
            }
        ))
        .pipe(gulp.dest('img'))
});

gulp.task('dev:watch', function () {
        gulp.watch('src/**',['compress_img']);
});

gulp.task('compile', ['compress_img']);