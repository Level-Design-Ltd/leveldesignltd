"use strict";
self["webpackHotUpdate_roots_bud_sage_sage"]("app",{

/***/ "./scripts/layout/blob.js":
/*!********************************!*\
  !*** ./scripts/layout/blob.js ***!
  \********************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
let canvas, ctx;
let render, init;
let blob;
class Blob {
  constructor() {
    this.points = [];
  }
  init() {
    for (let i = 0; i < this.numPoints; i++) {
      let point = new Point(this.divisional * (i + 1), this);
      this.push(point);
    }
  }
  render() {
    let canvas = this.canvas;
    let ctx = this.ctx;
    let position = this.position;
    let pointsArray = this.points;
    let radius = this.radius;
    let points = this.numPoints;
    let divisional = this.divisional;
    let center = this.center;
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    pointsArray[0].solveWith(pointsArray[points - 1], pointsArray[1]);
    let p0 = pointsArray[points - 1].position;
    let p1 = pointsArray[0].position;
    let _p2 = p1;
    ctx.beginPath();
    ctx.moveTo(center.x, center.y);
    ctx.moveTo((p0.x + p1.x) / 2, (p0.y + p1.y) / 2);
    for (let i = 1; i < points; i++) {
      pointsArray[i].solveWith(pointsArray[i - 1], pointsArray[i + 1] || pointsArray[0]);
      let p2 = pointsArray[i].position;
      var xc = (p1.x + p2.x) / 2;
      var yc = (p1.y + p2.y) / 2;
      if (i === Math.floor(points / 4) || i === Math.floor(points * 3 / 4)) {
        // This is the top and bottom of the bean, we want to push this point inwards
        let dx = p1.x - xc;
        let dy = p1.y - yc;
        let dist = Math.sqrt(dx * dx + dy * dy);
        xc -= dx / dist * 10;
        yc -= dy / dist * 10;
      }
      ctx.quadraticCurveTo(p1.x, p1.y, xc, yc);
      p1 = p2;
    }
    ctx.closePath();

    // Create a linear gradient
    const gradient = ctx.createLinearGradient(center.x - radius, center.y, center.x + radius, center.y);

    // Add color stops to the gradient
    gradient.addColorStop(0, "#e2b8f6"); // Start color
    gradient.addColorStop(1, "#7759d2"); // End color

    // Set the gradient as the fill style
    ctx.fillStyle = gradient;

    // Fill the blob with the gradient color
    ctx.fill();
    requestAnimationFrame(this.render.bind(this));
  }
  push(item) {
    if (item instanceof Point) {
      this.points.push(item);
    }
  }
  set color(value) {
    this._color = value;
  }
  get color() {
    return this._color || "#0091DA";
  }
  set canvas(value) {
    if (value instanceof HTMLElement && value.tagName.toLowerCase() === "canvas") {
      this._canvas = value;
      this.ctx = this._canvas.getContext("2d");
    }
  }
  get canvas() {
    return this._canvas;
  }
  set numPoints(value) {
    if (value > 2) {
      this._points = value;
    }
  }
  get numPoints() {
    return this._points || 32;
  }
  set radius(value) {
    if (value > 0) {
      this._radius = value;
    }
  }
  get radius() {
    return this._radius || 500;
  }
  set position(value) {
    if (typeof value == "object" && value.x && value.y) {
      this._position = value;
    }
  }
  get position() {
    return this._position || {
      x: 0.15,
      y: 0.25
    };
  }
  get divisional() {
    return Math.PI * 2 / this.numPoints;
  }
  get center() {
    return {
      x: this.canvas.width * this.position.x,
      y: this.canvas.height * this.position.y
    };
  }
  set running(value) {
    this._running = value === true;
  }
  get running() {
    return this.running !== false;
  }
}
class Point {
  constructor(azimuth, parent) {
    this.parent = parent;
    this.azimuth = Math.PI - azimuth;
    this._components = {
      x: Math.cos(this.azimuth),
      y: Math.sin(this.azimuth)
    };
    this.acceleration = -0.3 + Math.random() * 0.6;
  }
  solveWith(leftPoint, rightPoint) {
    this.acceleration = (-0.3 * this.radialEffect + (leftPoint.radialEffect - this.radialEffect) + (rightPoint.radialEffect - this.radialEffect)) * this.elasticity - this.speed * this.friction;
  }
  set acceleration(value) {
    if (typeof value == "number") {
      this._acceleration = value;
      this.speed += this._acceleration * 2;
    }
  }
  get acceleration() {
    return this._acceleration || 0;
  }
  set speed(value) {
    if (typeof value == "number") {
      this._speed = value;
      this.radialEffect += this._speed * 5;
    }
  }
  get speed() {
    return this._speed || 0;
  }
  set radialEffect(value) {
    if (typeof value == "number") {
      this._radialEffect = value;
    }
  }
  get radialEffect() {
    return this._radialEffect || 0;
  }
  get position() {
    let undistorted = {
      x: this.parent.center.x + this.components.x * (this.parent.radius + this.radialEffect),
      y: this.parent.center.y + this.components.y * (this.parent.radius + this.radialEffect)
    };
    let distortionFactor = 0.6; // Change this to distort the blob more or less

    // Introduce an offset to the azimuth to control the location of the indentation
    let azimuthOffset = Math.PI / 2;
    let distortion = 1 + distortionFactor * Math.sin(this.azimuth + azimuthOffset);
    let position = {
      x: this.parent.center.x + distortion * (undistorted.x - this.parent.center.x),
      y: this.parent.center.y + distortion * (undistorted.y - this.parent.center.y)
    };
    return position;
  }
  get components() {
    return this._components;
  }
  set elasticity(value) {
    if (typeof value === "number") {
      this._elasticity = value;
    }
  }
  get elasticity() {
    return this._elasticity || 0.001;
  }
  set friction(value) {
    if (typeof value === "number") {
      this._friction = value;
    }
  }
  get friction() {
    return this._friction || 0.0085;
  }
}
blob = new Blob();
let style = getComputedStyle(document.body);
blob.position = {
  x: parseFloat(style.getPropertyValue("--blob-position-x")),
  y: parseFloat(style.getPropertyValue("--blob-position-y"))
};
init = function () {
  const blobContainer = document.querySelector(".blob");
  canvas = document.createElement("canvas");
  canvas.setAttribute("touch-action", "none");
  blobContainer.appendChild(canvas);
  let resize = function () {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  };
  window.addEventListener("resize", resize);
  resize();
  let oldMousePoint = {
    x: 0,
    y: 0
  };
  let hover = false;
  let mouseMove = function (e) {
    let pos = blob.center;
    let diff = {
      x: e.clientX - pos.x,
      y: e.clientY - pos.y
    };
    let dist = Math.sqrt(diff.x * diff.x + diff.y * diff.y);
    let angle = null;
    blob.mousePos = {
      x: pos.x - e.clientX,
      y: pos.y - e.clientY
    };
    if (dist < blob.radius && hover === false) {
      let vector = {
        x: e.clientX - pos.x,
        y: e.clientY - pos.y
      };
      angle = Math.atan2(vector.y, vector.x);
      hover = true;
    } else if (dist > blob.radius && hover === true) {
      let vector = {
        x: e.clientX - pos.x,
        y: e.clientY - pos.y
      };
      angle = Math.atan2(vector.y, vector.x);
      hover = false;
      blob.color = null;
    }
    if (typeof angle == "number") {
      let nearestPoint = null;
      let distanceFromPoint = 100;
      blob.points.forEach(point => {
        if (Math.abs(angle - point.azimuth) < distanceFromPoint) {
          nearestPoint = point;
          distanceFromPoint = Math.abs(angle - point.azimuth);
        }
      });
      if (nearestPoint) {
        let strength = {
          x: oldMousePoint.x - e.clientX,
          y: oldMousePoint.y - e.clientY
        };
        strength = Math.sqrt(strength.x * strength.x + strength.y * strength.y) * 10;
        if (strength > 100) strength = 100;
        nearestPoint.acceleration = strength / 100 * (hover ? -1 : 1);
      }
    }
    oldMousePoint.x = e.clientX;
    oldMousePoint.y = e.clientY;
  };
  window.addEventListener("pointermove", mouseMove);
  blob.canvas = canvas;
  blob.init();
  blob.render();
};
init();

/***/ })

});
//# sourceMappingURL=app.b808d86cd36b589bbb5c.hot-update.js.map