var gulp=require("gulp"),sass=require("gulp-sass");gulp.task("default",function(){gulp.src("./public/css/*.scss").pipe(sass({style:"compressed"})).pipe(gulp.dest("./public/css"))});