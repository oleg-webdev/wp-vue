var gulp          = require('gulp'),
		aa_concat     = require('gulp-concat'),
		aa_rename     = require('gulp-rename'),
		aa_uglify     = require('gulp-uglify'),
		aa_sourcemaps = require('gulp-sourcemaps');

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
gulp.task('aa-concat', function() {
	return gulp.src(processFiles)
		.pipe(aa_sourcemaps.init())
		.pipe(aa_concat('plugins-concat.js'))
		.pipe(gulp.dest(devRoot))
		.pipe(aa_rename('plugins-uglify.js'))
		.pipe(aa_uglify())
		.pipe(aa_sourcemaps.write('./'))
		.pipe(gulp.dest(prodRoot));
});

gulp.task('watch', function() {
	gulp.watch(processFiles, ['aa-concat']);
});

gulp.task('default', ['aa-concat'], function() {
});