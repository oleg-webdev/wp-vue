var gulp        = require('gulp'),
		gulpConcat  = require('gulp-concat'),
		gulpRename  = require('gulp-rename'),
		gulpUglify  = require('gulp-uglify'),
		sourcemaps  = require('gulp-sourcemaps'),
		gulpSass    = require('gulp-sass'),
		gulpReplace = require('gulp-replace');

var devRoot   = "script/dev/",
		bowerRoot = "bower_components/",
		bootjs    = bowerRoot + "/bootstrap/js/",
		prodRoot  = "script/prod/";

var processFiles = [
	// bootjs + 'affix.js',
	// bootjs + 'alert.js',
	// bootjs + 'button.js',
	// bootjs + 'carousel.js',
	// bootjs + 'collapse.js',
	// bootjs + 'dropdown.js',
	// bootjs + 'popover.js',
	// bootjs + 'scrollspy.js',
	// bootjs + 'tab.js',
	// bootjs + 'tooltip.js',
	// bootjs + 'transition.js',
];
// @TODO: Should be tested
gulp.task('aa-concat', () => {
	return gulp.src(processFiles)
		.pipe(sourcemaps.init())
		.pipe(gulpConcat('plugins-concat.js'))
		.pipe(gulp.dest(devRoot))
		.pipe(gulpRename('plugins-uglify.js'))
		.pipe(gulpUglify())
		.pipe(sourcemaps.write('./'))
		.pipe(gulp.dest(prodRoot));
});

gulp.task('sass-frontend', () => {
	gulp.src([
		'style.scss',
		'style-parts/*.scss',
		'style-parts/frontend/*.scss'
	])
		.pipe(sourcemaps.init()) // remove for production
		.pipe(gulpSass({outputStyle: 'compressed'})
			.on('error', gulpSass.logError))
		.pipe(sourcemaps.write('./')) // remove for production
		.pipe(gulp.dest('./'))

});

gulp.task('csschange', function(){
	gulp.src(['style.css'])
		.pipe(gulpReplace('../../img', 'img'))
		.pipe(gulp.dest('./'));
});


gulp.task('sass-backend', () => {
	gulp.src([
		'style-parts/*.scss',
		'style-parts/backend/*.scss'
	])
		.pipe(sourcemaps.init()) // remove for production
		.pipe(gulpSass({outputStyle: 'compressed'})
			.on('error', gulpSass.logError))
		.pipe(sourcemaps.write('./')) // remove for production
		.pipe(gulp.dest('./style-parts/backend/'));
});

gulp.task('watch', () => {

	// Scripts
	// gulp.watch(processFiles, ['aa-concat']);

	// Frontend Styles
	gulp.watch([
			'style.scss',
			'style-parts/*.scss',
			'style-parts/frontend/*.scss'
		],
		['sass-frontend'])

	gulp.watch(['style.css'], ['csschange'])

	// Backend Styles
	// gulp.watch(['style-parts/*.scss','style-parts/backend/*.scss'], ['sass-backend'])

});

gulp.task('default', ['aa-concat'], () => {
	console.log('Default task');
});