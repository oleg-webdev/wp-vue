let gulp        = require('gulp'),
		sourcemaps  = require('gulp-sourcemaps'),
		gulpSass    = require('gulp-sass'),
		gulpReplace = require('gulp-replace');

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