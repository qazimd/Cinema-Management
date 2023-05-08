// Load Page Parts a Home

document.addEventListener("DOMContentLoaded", function () {
  var header = document.querySelector("header");
  var footer = document.querySelector("footer");

  fetch("includes/header.php")
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      header.innerHTML = data;
    });

  fetch("includes/footer.php")
    .then(function (response) {
      return response.text();
    })
    .then(function (data) {
      footer.innerHTML = data;
    });
});

// Movie Trailers Section image to video efect
var trailers = document.querySelectorAll(".trailer-item-info");
for (var i = 0; i < trailers.length; i++) {
  trailers[i].addEventListener("click", function () {
    var video = document.createElement("iframe");
    video.className = "trailer-item-video";
    video.src =
      "https://www.youtube.com/embed/" + this.dataset.video + "?controls=0";
    video.height = "100%";
    video.width = "100%";
    video.frameborder = "0";
    this.parentNode.querySelector("img").replaceWith(video);
    this.style.display = "none";
  });
}

// faded scroll

document.addEventListener("DOMContentLoaded", function () {
  var documentElement = document.documentElement,
    fadeElements = document.querySelectorAll(".fade-scroll");

  documentElement.addEventListener("scroll", function () {
    var currScrollPos = documentElement.scrollTop;

    fadeElements.forEach(function (fadeElement) {
      var elemOffsetTop = fadeElement.offsetTop;
      if (currScrollPos > elemOffsetTop) {
        fadeElement.style.opacity = 1 - (currScrollPos - elemOffsetTop) / 400;
      }
    });
  });
});
