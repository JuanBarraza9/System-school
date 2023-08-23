const { src, dest, watch , parallel } = require('gulp');
const sass = require ('sass');
const fs = require('fs');
const sourcemaps = require('gulp-sourcemaps')
const concat = require('gulp-concat');
const terser = require('gulp-terser-js');
const rename = require('gulp-rename');
const imagemin = require('gulp-imagemin');
const notify = require('gulp-notify');
const cache = require('gulp-cache');
const webp = require('gulp-webp');

const paths = {
    js: 'resources/js/**/*.js',
    imagenes: 'resources/img/**/*',
    scss: 'resources/scss/**/*.scss'
}


function compileSass() {
    const mainScssPath = 'resources/scss/style.scss';

    const resultCss = sass.renderSync({
      file: mainScssPath,
      outputStyle: 'expanded',
    });
  
    fs.writeFileSync('./public/build/css/style.css', resultCss.css);
  
    return src('./public/build/css/style.css');
}


// JAVASCRIPT
function javascript() {
    return src(paths.js)
      .pipe(sourcemaps.init())
      .pipe(concat('bundle.js')) // final output file name
      .pipe(terser())
      .pipe(sourcemaps.write('.'))
      .pipe(rename({ suffix: '.min' }))
      .pipe(dest('./public/build/js'))
}

function imagenes() {
    return src(paths.imagenes)
        .pipe(cache(imagemin({ optimizationLevel: 3})))
        .pipe(dest('./public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}

function versionWebp() {
    return src(paths.imagenes)
        .pipe( webp() )
        .pipe(dest('./public/build/img'))
        .pipe(notify({ message: 'Imagen Completada'}));
}


// Tarea para observar cambios y ejecutar la compilación
function watchArchivos() {
    watch( paths.js, javascript );
    watch( paths.imagenes, imagenes );
    watch( paths.imagenes, versionWebp );
    watch(paths.scss, compileSass);
}
  
exports.default = parallel(javascript,  imagenes, versionWebp, watchArchivos); 