<!DOCTYPE html>
<html>
<style>
body, html {
  height: 100%;
  margin: 0;
  background-color: #000000;
}

.bgimg {
 margin-left: auto;
  	margin-right: auto;
   object-fit: fill;
  display: block;
    height: 100%;
}

.topleft {
  position: absolute;
  top: 0;
  left: 16px;
}

.bottomleft {
  position: absolute;
  bottom: 0;
  left: 16px;
}

.middle {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  text-align: center;
}

hr {
  margin: auto;
  width: 40%;
}
</style>
<body>
    <img src="{{ asset('main/bg.jpg') }}" class="bgimg">
</div>
</body>
</html>