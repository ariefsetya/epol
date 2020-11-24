@extends('layouts.camera')

@section('content')
<style type="text/css">
.page-container {
  left: 0;
  right: 0;
  margin: auto;
  margin-top: 20px;
  width: 100%;
  height: 100%;
  display: inline-flex !important;
}

@media only screen and (max-width : 992px) {
  .page-container {
    padding-left: 0;
    display: flex !important;
  }
}

#navbar {
  position: absolute;
  top: 20px;
  left: 20px;
}

.center-content {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

.side-by-side {
  display: flex;
  justify-content: center;
  align-items: center;
}
.side-by-side >* {
  margin: 0 5px;
}

.bold {
  font-weight: bold;
}

.margin-sm {
  margin: 5px;
}

.margin {
  margin: 20px;
}

.button-sm {
  padding: 0 10px !important;
}

.pad-sides-sm {
  padding: 0 8px !important;
}

#github-link {
  display: flex !important;
  justify-content: center;
  align-items: center;
  border-bottom: 1px solid;
  margin-bottom: 10px;
}

#overlay, .overlay {
  position: absolute;
  top: 0;
  left: 0;
}

#facesContainer canvas {
  margin: 0 auto;
}

</style>

    <div style="position: relative" class="margin"   style="width: 100%;height: 100%;">
      <video onloadedmetadata="onPlay(this)" id="inputVideo" autoplay muted playsinline   style="width: 100%;height: 100%;"></video>
      <canvas id="overlay" style="width: 100%;height: 100%;"></canvas>

    </div>
      <div id="capturedimage" style="display: none;"></div>

      <div id="facesContainer" style="display: none;"></div>
      <button class="btn btn-lg btn-dark btn-block" id="getImage" style="display: none;" onclick="getImage()">Ambil Foto</button>
@endsection

@section('footer')
  <script src="{{url('')}}:9000/face-api.js"></script>
  <script src="{{url('')}}:9000/commons.js"></script>
  <script type="text/javascript">

      let minConfidence = 0.5

    async function onPlay() {
      const videoEl = $('#inputVideo').get(0)
      
      if(videoEl.paused || videoEl.ended)
        return setTimeout(() => onPlay())


      const options = new faceapi.SsdMobilenetv1Options({ minConfidence })

      const ts = Date.now()

      const result = await faceapi.detectAllFaces(videoEl, options)
        .withFaceLandmarks()
        .withFaceDescriptors()

      if (result) {
        console.log(result)
        const canvas = $('#overlay').get(0)
        const dims = faceapi.matchDimensions(canvas, videoEl, true)

        faceapi.draw.drawDetections(canvas, faceapi.resizeResults(result, dims))
        $("#getImage").fadeIn();

      }

      setTimeout(() => onPlay())
    }


    function displayExtractedFaces(faceImages) {
      $('#facesContainer').empty()
      // console.log(faceImages)
      faceImages.forEach(canvas => {
        $('#facesContainer').append(canvas)
        saveImage(canvas.toDataURL())
      })
    }

    function saveImage(image) {
      $.ajax({
          url: "{{route('invitation.process_register_face')}}", 
          dataType:'json',
          data:{
            image:image,
            _token:'{{csrf_token()}}'
          },
          method:'POST',
          success: function(result){
            window.location = '{{url('')}}'
        }
      });
    }

    function getCurrentFaceDetectionNet() {
        return faceapi.nets.ssdMobilenetv1
    }

    function isFaceDetectionModelLoaded() {
      return !!getCurrentFaceDetectionNet().params
    }


    var $image = $("#capturedimage");
    var video = $("#inputVideo").get(0);

    async function getImage() {
        var canvas = document.createElement("canvas");
        canvas.getContext('2d')
            .drawImage(video, 0, 0, canvas.width, canvas.height);

        var img = document.createElement("img");
        img.src = canvas.toDataURL();
        $image.prepend(img);

        const options = new faceapi.SsdMobilenetv1Options({ minConfidence })

        const detections = await faceapi.detectAllFaces(img, options)
        const faceImages = await faceapi.extractFaces(img, detections)
        
        displayExtractedFaces(faceImages)
    };

    async function run() {

      if (!isFaceDetectionModelLoaded()) {
        await getCurrentFaceDetectionNet().load('/models')
      }

      await faceapi.loadFaceLandmarkModel('/models')
      await faceapi.loadFaceRecognitionModel('/models')

      // faceMatcher = await createBbtFaceMatcher(1)
      // try to access users webcam and stream the images
      // to the video element
      const stream = await navigator.mediaDevices.getUserMedia({ video: {} })
      const videoEl = $('#inputVideo').get(0)
      videoEl.srcObject = stream
    }

    function updateResults() {}

    $(document).ready(function() {
      run()
    })

  </script>
@endsection