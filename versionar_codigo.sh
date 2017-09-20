#versionando
echo $1 > resources/views/plantilla/version.blade.php
git add .
git commit -m "$1"
git push origin $1
git tag "$1" #version
git push --tags

