const gulp         = require('gulp');
const sass         = require('gulp-sass');
const del          = require('del');
const browserSync  = require('browser-sync').create();
const files        = ['./*.php']; //for browser sync
const autoprefixer = require('gulp-autoprefixer');
const cleanCSS     = require('gulp-clean-css');
const concat       = require('gulp-concat');
const uglify       = require('gulp-uglifyjs');
const rename       = require('gulp-rename');
const imagemin     = require('gulp-imagemin');
const pngquant     = require('imagemin-pngquant');
const cache        = require('gulp-cache');
const jsFiles      = [
						'./assets/libs/fancybox/jquery.fancybox.js',
						'./assets/libs/scroller/jquery.mCustomScrollbar.js'
					];
const cssFiles      = [
						'./assets/libs/fancybox/jquery.fancybox.css',
						'./assets/libs/scroller/jquery.mCustomScrollbar.css'
					];

function sass_my(){
	return gulp.src('./assets/sass/main.scss')
		.pipe(sass())
		.pipe(autoprefixer({
			browsers: ['> 0.1%'],
			cascade: false
		}))
		// .pipe(cleanCSS({
		// 	level: 2
		// }))
		// .pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('./build/css'))
		.pipe(browserSync.stream()); //for browser sync
}

function css_libs(){
	return gulp.src(cssFiles)
		.pipe(concat('libs.min.css'))
		.pipe(cleanCSS({
			level: 2
		}))
		.pipe(gulp.dest('./build/css'))
}

function scripts_custom() {
	return gulp.src('./assets/js/custom.js')
		// .pipe(uglify({
		// 	toplevel: true
		// }))
		// .pipe(rename({suffix: '.min'}))
		.pipe(gulp.dest('./build/js'))
		.pipe(browserSync.stream()); //for browser sync
}

function scripts_libs(){
	return gulp.src(jsFiles)
		.pipe(concat('libs.min.js'))
		.pipe(uglify({
			toplevel: true
		}))
		.pipe(gulp.dest('./build/js'))
}

function fonts(){
	return gulp.src('./assets/fonts/**/*')
		.pipe(gulp.dest('./build/fonts'))
}

function images(){
	return gulp.src('./assets/images/**/*')
		.pipe(imagemin({
			interlaced: true,
			progressive: true,
			svgoPlugins: [{removeVievBox: false}],
			une: [pngquant()]
		}))
		.pipe(gulp.dest('./build/images'))	
}

function clean(){
	return del(['build/*']);
}

function watch(){
	browserSync.init({
		files: files,
		proxy: "zgame.loc",
		notify: false
    });
	gulp.watch('./assets/sass/**/*.scss', sass_my);
	gulp.watch('./assets/js/**/*.js', scripts_custom);
	gulp.watch('./*.php', browserSync.reload); //for browser sync
}

gulp.task('clean', clean);
gulp.task('styles', sass_my);
gulp.task('css-libs', css_libs);
gulp.task('scripts-custom', scripts_custom);
gulp.task('scripts-libs', scripts_libs);
gulp.task('fonts', fonts);
gulp.task('images', images);
gulp.task('watch', watch);

gulp.task('build', gulp.series(clean, //пересоберет заново все
		gulp.parallel(sass_my, scripts_custom, css_libs, scripts_libs, fonts, images)
		//здесь либо названия функций без '' либо название таска в''
	));

gulp.task('dev', gulp.series('build', 'watch')); //пересоберет заново все + запустит watcher