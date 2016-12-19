var gulp           = require('gulp'),
		gulpConcat     = require('gulp-concat'),
		gulpRename     = require('gulp-rename'),
		gulpUglify     = require('gulp-uglify'),
		gulpSourcemaps = require('gulp-sourcemaps'),
		gulpSass       = require('gulp-sass');

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
		.pipe(gulpSourcemaps.init())
		.pipe(gulpConcat('plugins-concat.js'))
		.pipe(gulp.dest(devRoot))
		.pipe(gulpRename('plugins-uglify.js'))
		.pipe(gulpUglify())
		.pipe(gulpSourcemaps.write('./'))
		.pipe(gulp.dest(prodRoot));
});

gulp.task('sass-frontend', () => {
	gulp.src(['style.scss',
						'style-parts/*.scss',
						'style-parts/frontend/*.scss'])
		.pipe(gulpSourcemaps.init()) // remove for production
		.pipe(gulpSass({outputStyle: 'compressed'})
			.on('error', gulpSass.logError))
		.pipe(gulpSourcemaps.write()) // remove for production
		.pipe(gulp.dest('./'));
});

gulp.task('sass-backend', () => {
	gulp.src(['style-parts/*.scss',
						'style-parts/backend/*.scss'])
		.pipe(gulpSourcemaps.init()) // remove for production
		.pipe(gulpSass({outputStyle: 'compressed'})
			.on('error', gulpSass.logError))
		.pipe(gulpSourcemaps.write()) // remove for production
		.pipe(gulp.dest('./style-parts/backend/'));
});

gulp.task('watch', () => {

	// Scripts
	// gulp.watch(processFiles, ['aa-concat']);

	// Frontend Styles
	gulp.watch(['style.scss','style-parts/*.scss','style-parts/frontend/*.scss'], ['sass-frontend'])

	// Backend Styles
	// gulp.watch(['style-parts/*.scss','style-parts/backend/*.scss'], ['sass-backend'])

});

gulp.task('default', ['aa-concat'], () => {
	console.log('Default task');
});