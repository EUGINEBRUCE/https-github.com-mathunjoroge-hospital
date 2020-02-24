<script type="text/javascript">
var spawn = require('child_process').spawn,
    child    = spawn('C:\\Program Files\\RadiAntViewer64bit\\RadiAntViewer.exe', ["C:/xampp/htdocs/hospital/doctors/aglwggjyzvq.zip"]);
child.stdout.on('data', function (data) {
  console.log('stdout: ' + data);
});

child.stderr.on('data', function (data) {
  console.log('stderr: ' + data);
});

child.on('close', function (code) {
  console.log('child process exited with code ' + code);
});
</script>