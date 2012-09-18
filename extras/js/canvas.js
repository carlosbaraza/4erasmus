

$( function() {
//	classDefinition()
//	fizzle = new Game()
//	fizzle.webGLStart()
/*
	    var gl;    
	    function initGL(canvas) {        
	    	try {            
	    		gl = canvas.getContext("experimental-webgl");            
	    		gl.viewportWidth = canvas.width;            
	    		gl.viewportHeight = canvas.height;        
	    	} catch (e) {        
	    	}        
	    	if (!gl) {            
	    		alert("Could not initialise WebGL, sorry :-(");        
	    	}    
	    }    
	    function getShader(gl, id) {        
	    	var shaderScript = document.getElementById(id);        
	    	if (!shaderScript) {            
	    		return null;        
	    	}        
	    	var str = "";        
	    	var k = shaderScript.firstChild;        
	    	while (k) {            
	    		if (k.nodeType == 3) {                
	    			str += k.textContent;            
	    		}            
	    		k = k.nextSibling;        
	    	}        
	    	var shader;        
	    	if (shaderScript.type == "x-shader/x-fragment") {            
	    		shader = gl.createShader(gl.FRAGMENT_SHADER);       
	    	} else if (shaderScript.type == "x-shader/x-vertex") {            
	    		shader = gl.createShader(gl.VERTEX_SHADER);        
	    	} else {            
	    		return null;        
	    	}        
	    	gl.shaderSource(shader, str);        
	    	gl.compileShader(shader);        
	    	if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {            
	    		alert(gl.getShaderInfoLog(shader));            
	    		return null;        
	    	}        
	    	return shader;    
	    }    
	    var shaderProgram;    
	    function initShaders() {        
	    	var fragmentShader = getShader(gl, "shader-fs");        
	    	var vertexShader = getShader(gl, "shader-vs");        
	    	shaderProgram = gl.createProgram();        
	    	gl.attachShader(shaderProgram, vertexShader);        
	    	gl.attachShader(shaderProgram, fragmentShader);        
	    	gl.linkProgram(shaderProgram);        
	    	if (!gl.getProgramParameter(shaderProgram, gl.LINK_STATUS)) {            
	    		alert("Could not initialise shaders");        
	    	}        
    		gl.useProgram(shaderProgram);        
    		shaderProgram.vertexPositionAttribute = 
    		gl.getAttribLocation(shaderProgram, "aVertexPosition");        
    		gl.enableVertexAttribArray(shaderProgram.vertexPositionAttribute);        
    		shaderProgram.vertexColorAttribute = gl.getAttribLocation(shaderProgram, "aVertexColor");        
    		gl.enableVertexAttribArray(shaderProgram.vertexColorAttribute);        
    		shaderProgram.pMatrixUniform = gl.getUniformLocation(shaderProgram, "uPMatrix");        
    		shaderProgram.mvMatrixUniform = gl.getUniformLocation(shaderProgram, "uMVMatrix");    
    	}    
	    	
	    	var mvMatrix = mat4.create();    
	    	var mvMatrixStack = [];    
	    	var pMatrix = mat4.create();    
	    	
	    	function mvPushMatrix() {        
	    		var copy = mat4.create();        
	    		mat4.set(mvMatrix, copy);        
	    		mvMatrixStack.push(copy);    
	    	}    

	    	function mvPopMatrix() {        
	    		if (mvMatrixStack.length == 0) {            
	    			throw "Invalid popMatrix!";        
	    		}        mvMatrix = mvMatrixStack.pop();    
	    	}    

	    	function setMatrixUniforms() {        
	    		gl.uniformMatrix4fv(shaderProgram.pMatrixUniform, false, pMatrix);        
	    		gl.uniformMatrix4fv(shaderProgram.mvMatrixUniform, false, mvMatrix);    
	    	}    

	    	function degToRad(degrees) {        
	    		return degrees * Math.PI / 180;    
	    	}    

	    	var pyramidVertexPositionBuffer;    
	    	var pyramidVertexColorBuffer;    
	    	var cubeVertexPositionBuffer;    
	    	var cubeVertexColorBuffer;    

	    	function initBuffers() {        
	    		pyramidVertexPositionBuffer = gl.createBuffer();        
	    		gl.bindBuffer(gl.ARRAY_BUFFER, pyramidVertexPositionBuffer);        
	    		var vertices = [             
	    		0.0,  1.0,  0.0,            
	    		-1.0, -1.0,  0.0,             
	    		1.0, -1.0,  0.0        
	    		];        
	    		gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);        
	    		pyramidVertexPositionBuffer.itemSize = 3;        
	    		pyramidVertexPositionBuffer.numItems = 3;        
	    		pyramidVertexColorBuffer = gl.createBuffer();        
	    		gl.bindBuffer(gl.ARRAY_BUFFER, pyramidVertexColorBuffer);        
	    		var colors = [            
	    		1.0, 0.0, 0.0, 1.0,            
	    		0.0, 1.0, 0.0, 1.0,            
	    		0.0, 0.0, 1.0, 1.0,        
	    		];        

	    		gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(colors), gl.STATIC_DRAW);       
    			 pyramidVertexColorBuffer.itemSize = 4;        
    			 pyramidVertexColorBuffer.numItems = 3;        
    			 cubeVertexPositionBuffer = gl.createBuffer();        
    			 gl.bindBuffer(gl.ARRAY_BUFFER, cubeVertexPositionBuffer);        
    			 vertices = [             
	    			 1.0,  1.0,  0.0,            
	    			 -1.0,  1.0,  0.0,             
	    			 1.0, -1.0,  0.0,            
	    			 -1.0, -1.0,  0.0            
	    		];        
	    		gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);        
	    		cubeVertexPositionBuffer.itemSize = 3;        
	    		cubeVertexPositionBuffer.numItems = 4;        
	    		cubeVertexColorBuffer = gl.createBuffer();        
	    		gl.bindBuffer(gl.ARRAY_BUFFER, cubeVertexColorBuffer);        
	    		colors = []        
	    		for (var i=0; i < 4; i++) {            
	    			colors = colors.concat([0.5, 0.5, 1.0, 1.0]);        
	    		}        
	    		gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(colors), gl.STATIC_DRAW);        
	    		cubeVertexColorBuffer.itemSize = 4;        
	    		cubeVertexColorBuffer.numItems = 4;    
	    	}    
	    	var rPyramid = 0;    
	    	var rCube = 0;    

	    	function drawScene() {        
	    		gl.viewport(0, 0, gl.viewportWidth, gl.viewportHeight);       
	    		 gl.clear(gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);        
	    		 mat4.perspective(45, gl.viewportWidth / gl.viewportHeight, 0.1, 100.0, pMatrix);        
	    		 mat4.identity(mvMatrix);        mat4.translate(mvMatrix, [-1.5, 0.0, -7.0]);        
	    		 mvPushMatrix();        mat4.rotate(mvMatrix, degToRad(rPyramid), [0, 1, 0]);        
	    		 gl.bindBuffer(gl.ARRAY_BUFFER, pyramidVertexPositionBuffer);        
	    		 gl.vertexAttribPointer(shaderProgram.vertexPositionAttribute, 
	    		 	pyramidVertexPositionBuffer.itemSize, gl.FLOAT, false, 0, 0);        
	    		 gl.bindBuffer(gl.ARRAY_BUFFER, pyramidVertexColorBuffer);        
	    		 gl.vertexAttribPointer(shaderProgram.vertexColorAttribute, pyramidVertexColorBuffer.itemSize, gl.FLOAT, false, 0, 0);        
	    		 setMatrixUniforms();        gl.drawArrays(gl.pyramidS, 0, pyramidVertexPositionBuffer.numItems);        
	    		 mvPopMatrix();        
	    		 mat4.translate(mvMatrix, [3.0, 0.0, 0.0]);        
	    		 mvPushMatrix();        
	    		 mat4.rotate(mvMatrix, degToRad(rCube), [1, 0, 0]);        
	    		 gl.bindBuffer(gl.ARRAY_BUFFER, cubeVertexPositionBuffer);       
	    		 gl.vertexAttribPointer(shaderProgram.vertexPositionAttribute, cubeVertexPositionBuffer.itemSize, gl.FLOAT, false, 0, 0);        
	    		 gl.bindBuffer(gl.ARRAY_BUFFER, cubeVertexColorBuffer);        
	    		 gl.vertexAttribPointer(shaderProgram.vertexColorAttribute, cubeVertexColorBuffer.itemSize, gl.FLOAT, false, 0, 0);        
	    		 setMatrixUniforms();       
	    		 gl.drawArrays(gl.pyramid_STRIP, 0, cubeVertexPositionBuffer.numItems);        
	    		 mvPopMatrix();    
	    	}    
	    		 var lastTime = 0;    

	    		 function animate() {        
	    		 	var timeNow = new Date().getTime();        
	    		 	if (lastTime != 0) {            
	    		 		var elapsed = timeNow - lastTime;           
	    		 		rPyramid += (90 * elapsed) / 1000.0;            
	    		 		rCube += (75 * elapsed) / 1000.0;        
	    		 	}        
	    		 	lastTime = timeNow;    
	    		 }    

	    		 function tick() {        
	    		 	requestAnimFrame(tick);        
	    		 	drawScene();        
	    		 	animate();    
    		 	}    

	    		 function webGLStart() {        
	    		 	var canvas = document.getElementById("canvas");        
	    		 	initGL(canvas);        
	    		 	initShaders()        
	    		 	initBuffers();        
	    		 	gl.clearColor(0.0, 0.0, 0.0, 1.0);        
	    		 	gl.enable(gl.DEPTH_TEST);        
	    		 	tick();    
	    		 }
	    	webGLStart()*/
})


function classDefinition() {

/*
	// CONSTRUCTOR
	Game = function(id) {
		this.pyramidVertexPositionBuffer
		this.pyramidVertexColorBuffer
		this.cubeVertexPositionBuffer
		this.cubeVertexColorBuffer
		this.gl
    	this.mvMatrix = mat4.create()
    	this.pMatrix = mat4.create()
    	this.shaderProgram
    	this.webGLStart()
	}

	// PROTOTYPE
	Game.prototype = {

	    constructor: Game,

	    draw: function() {        
        	
		},

	    webGLStart: function() {
	  	 	var canvas = document.getElementById("canvas");
		    this.initGL(canvas);
		    this.initShaders(this.gl);
		    this.initBuffers(this.gl);

		    this.gl.clearColor(0.0, 0.0, 0.0, 1.0);
		    this.gl.enable(this.gl.DEPTH_TEST);

		    
		    this.anim()
	  	},

	  	initGL: function(canvas) {
	  		try {
	            this.gl = canvas.getContext("experimental-webgl");
	            this.gl.viewportWidth = canvas.width;
	            this.gl.viewportHeight = canvas.height;
	        } catch (e) {
	        }
	        if (!this.gl) {
	            alert("Could not initialise WebGL, sorry :-(");
	        }
	  	},

	  	initShaders: function(gl) {
	  		var fragmentShader = this.getShader(this.gl, "shader-fs");
	        var vertexShader = this.getShader(this.gl, "shader-vs");

	        this.shaderProgram = gl.createProgram();
	        gl.attachShader(this.shaderProgram, vertexShader);
	        gl.attachShader(this.shaderProgram, fragmentShader);
	        gl.linkProgram(this.shaderProgram);

	        if (!gl.getProgramParameter(this.shaderProgram, gl.LINK_STATUS)) {
	            alert("Could not initialise shaders");
	        }

	        gl.useProgram(this.shaderProgram);

		    this.shaderProgram.vertexPositionAttribute = gl.getAttribLocation(this.shaderProgram, "aVertexPosition");
		    gl.enableVertexAttribArray(this.shaderProgram.vertexPositionAttribute);

		    this.shaderProgram.vertexColorAttribute = gl.getAttribLocation(this.shaderProgram, "aVertexColor");
		    gl.enableVertexAttribArray(this.shaderProgram.vertexColorAttribute);

	        this.shaderProgram.pMatrixUniform = gl.getUniformLocation(this.shaderProgram, "uPMatrix");
	        this.shaderProgram.mvMatrixUniform = gl.getUniformLocation(this.shaderProgram, "uMVMatrix");
	  	},

	  	getShader: function(gl, id) {
	  		var shaderScript = document.getElementById(id);
	        if (!shaderScript) {
	            return null;
	        }

	        var str = "";
	        var k = shaderScript.firstChild;
	        while (k) {
	            if (k.nodeType == 3) {
	                str += k.textContent;
	            }
	            k = k.nextSibling;
	        }

	        var shader;
	        if (shaderScript.type == "x-shader/x-fragment") {
	            shader = gl.createShader(gl.FRAGMENT_SHADER);
	        } else if (shaderScript.type == "x-shader/x-vertex") {
	            shader = gl.createShader(gl.VERTEX_SHADER);
	        } else {
	            return null;
	        }

	        this.gl.shaderSource(shader, str);
	        this.gl.compileShader(shader);

	        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
	            alert(gl.getShaderInfoLog(shader));
	            return null;
	        }

	        return shader;
	  	},

	  	initBuffers: function(gl) {
	        this.pyramidVertexPositionBuffer = gl.createBuffer();
	        gl.bindBuffer(this.gl.ARRAY_BUFFER, this.pyramidVertexPositionBuffer);
	        var vertices = [
	             0.0,  1.0,  0.0,
	            -1.0, -1.0,  0.0,
	             1.0, -1.0,  0.0
	        ];
	        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);
	        this.pyramidVertexPositionBuffer.itemSize = 3;
	        this.pyramidVertexPositionBuffer.numItems = 3;

	        this.pyramidVertexColorBuffer = gl.createBuffer();
		    gl.bindBuffer(gl.ARRAY_BUFFER, this.pyramidVertexColorBuffer);
		    var colors = [
		        1.0, 0.0, 0.0, 1.0,
		        0.0, 1.0, 0.0, 1.0,
		        0.0, 0.0, 1.0, 1.0
		    ];
		    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(colors), gl.STATIC_DRAW);
		    this.pyramidVertexColorBuffer.itemSize = 4;
		    this.pyramidVertexColorBuffer.numItems = 3;

	        this.cubeVertexPositionBuffer = gl.createBuffer();
	        gl.bindBuffer(gl.ARRAY_BUFFER, this.cubeVertexPositionBuffer);
	        vertices = [
	             1.0,  1.0,  0.0,
	            -1.0,  1.0,  0.0,
	             1.0, -1.0,  0.0,
	            -1.0, -1.0,  0.0
	        ];
	        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);
	        this.cubeVertexPositionBuffer.itemSize = 3;
	        this.cubeVertexPositionBuffer.numItems = 4;

	        this.cubeVertexColorBuffer = gl.createBuffer();
		    gl.bindBuffer(gl.ARRAY_BUFFER, this.cubeVertexColorBuffer);
		    colors = []
		    for (var i=0; i < 4; i++) {
		      colors = colors.concat([0.5, 0.5, 1.0, 1.0]);
		    }
		    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(colors), gl.STATIC_DRAW);
		    this.cubeVertexColorBuffer.itemSize = 4;
		    this.cubeVertexColorBuffer.numItems = 4;
	  	},

	  	drawScene: function(gl) {
	        gl.viewport(0, 0, this.gl.viewportWidth, this.gl.viewportHeight);
	        gl.clear(this.gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);

	        mat4.perspective(45, this.gl.viewportWidth / gl.viewportHeight, 0.1, 100.0, this.pMatrix);

	        mat4.identity(this.mvMatrix);

	        // pyramid
	        mat4.translate(this.mvMatrix, [-1.5, 0.0, -7.0]);
	        gl.bindBuffer(gl.ARRAY_BUFFER, this.pyramidVertexPositionBuffer);
	        gl.vertexAttribPointer(this.shaderProgram.vertexPositionAttribute, this.pyramidVertexPositionBuffer.itemSize, gl.FLOAT, false, 0, 0);

	        gl.bindBuffer(gl.ARRAY_BUFFER, this.pyramidVertexColorBuffer);
    		gl.vertexAttribPointer(this.shaderProgram.vertexColorAttribute, this.pyramidVertexColorBuffer.itemSize, gl.FLOAT, false, 0, 0);

	        this.setMatrixUniforms();
	        gl.drawArrays(gl.pyramidS, 0, this.pyramidVertexPositionBuffer.numItems);

	        // cube
	        mat4.translate(this.mvMatrix, [3.0, 0.0, 0.0]);
	        gl.bindBuffer(gl.ARRAY_BUFFER, this.cubeVertexPositionBuffer);
	        gl.vertexAttribPointer(this.shaderProgram.vertexPositionAttribute, this.cubeVertexPositionBuffer.itemSize, gl.FLOAT, false, 0, 0);

	        gl.bindBuffer(gl.ARRAY_BUFFER, this.cubeVertexColorBuffer);
    		gl.vertexAttribPointer(this.shaderProgram.vertexColorAttribute, this.cubeVertexColorBuffer.itemSize, gl.FLOAT, false, 0, 0);

	        this.setMatrixUniforms();
	        gl.drawArrays(gl.pyramid_STRIP, 0, this.cubeVertexPositionBuffer.numItems);
	  	},

	  	setMatrixUniforms: function() {
	  		this.gl.uniformMatrix4fv(this.shaderProgram.pMatrixUniform, false, this.pMatrix);
        	this.gl.uniformMatrix4fv(this.shaderProgram.mvMatrixUniform, false, this.mvMatrix);
	  	},

	  	anim: function() {
		    requestAnimFrame(this.anim)
		    this.drawScene(this.gl)
		    alert()
	  	}
	}
*/

	// CONSTRUCTOR
	Game = function() {
		var pyramidVertexPositionBuffer
		  , pyramidVertexColorBuffer
		  , cubeVertexPositionBuffer
		  , cubeVertexColorBuffer
		  , cubeVertexIndexBuffer
		  , gl
    	  , shaderProgram
    	  , that = this

		that.mvMatrix = mat4.create()
		that.pMatrix = mat4.create()
	  	that.mvMatrixStack = new Array()
		that.rPyramid = 0
		that.rCube = 0
		that.lastTime = 0
		that.neheTexture
		that.xRot = 0
		that.yRot = 0
		that.zRot = 0

	    this.webGLStart = function() {
	  	 	var canvas = document.getElementById("canvas");
		    that.initGL(canvas);
		    that.initShaders(that.gl);
		    that.initBuffers(that.gl);
		    that.initTexture(that.gl)

		    that.gl.clearColor(0.0, 0.0, 0.0, 1.0);
		    that.gl.enable(that.gl.DEPTH_TEST);

		    that.anim()
	  	}

	  	this.initGL = function(canvas) {
	  		try {
	            that.gl = canvas.getContext("experimental-webgl");
	            that.gl.viewportWidth = canvas.width;
	            that.gl.viewportHeight = canvas.height;
	        } catch (e) {
	        }
	        if (!that.gl) {
	            alert("Could not initialise WebGL, sorry :-(");
	        }
	  	}

	  	this.initShaders = function(gl) {
	  		var fragmentShader = that.getShader(that.gl, "shader-fs");
	        var vertexShader = that.getShader(that.gl, "shader-vs");

	        that.shaderProgram = gl.createProgram();
	        gl.attachShader(that.shaderProgram, vertexShader);
	        gl.attachShader(that.shaderProgram, fragmentShader);
	        gl.linkProgram(that.shaderProgram);

	        if (!gl.getProgramParameter(that.shaderProgram, gl.LINK_STATUS)) {
	            alert("Could not initialise shaders");
	        }

	        gl.useProgram(that.shaderProgram);

		    that.shaderProgram.vertexPositionAttribute = gl.getAttribLocation(that.shaderProgram, "aVertexPosition");
		    gl.enableVertexAttribArray(that.shaderProgram.vertexPositionAttribute);

		    that.shaderProgram.vertexColorAttribute = gl.getAttribLocation(that.shaderProgram, "aVertexColor");
		    gl.enableVertexAttribArray(that.shaderProgram.vertexColorAttribute);

	        that.shaderProgram.pMatrixUniform = gl.getUniformLocation(that.shaderProgram, "uPMatrix");
	        that.shaderProgram.mvMatrixUniform = gl.getUniformLocation(that.shaderProgram, "uMVMatrix");
	  	}

	  	this.getShader = function(gl, id) {
	  		var shaderScript = document.getElementById(id);
	        if (!shaderScript) {
	            return null;
	        }

	        var str = "";
	        var k = shaderScript.firstChild;
	        while (k) {
	            if (k.nodeType == 3) {
	                str += k.textContent;
	            }
	            k = k.nextSibling;
	        }

	        var shader;
	        if (shaderScript.type == "x-shader/x-fragment") {
	            shader = gl.createShader(gl.FRAGMENT_SHADER);
	        } else if (shaderScript.type == "x-shader/x-vertex") {
	            shader = gl.createShader(gl.VERTEX_SHADER);
	        } else {
	            return null;
	        }

	        that.gl.shaderSource(shader, str);
	        that.gl.compileShader(shader);

	        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
	            alert(gl.getShaderInfoLog(shader));
	            return null;
	        }

	        return shader;
	  	}

	  	this.initBuffers = function(gl) {
	        that.pyramidVertexPositionBuffer = gl.createBuffer();
	        gl.bindBuffer(that.gl.ARRAY_BUFFER, that.pyramidVertexPositionBuffer);
	        var vertices = [
		        // Front face
		         0.0,  1.0,  0.0,
		        -1.0, -1.0,  1.0,
		         1.0, -1.0,  1.0,
		        // Right face
		         0.0,  1.0,  0.0,
		         1.0, -1.0,  1.0,
		         1.0, -1.0, -1.0,
		        // Back face
		         0.0,  1.0,  0.0,
		         1.0, -1.0, -1.0,
		        -1.0, -1.0, -1.0,
		        // Left face
		         0.0,  1.0,  0.0,
		        -1.0, -1.0, -1.0,
		        -1.0, -1.0,  1.0
		    ];
	        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);
	        that.pyramidVertexPositionBuffer.itemSize = 3;
	        that.pyramidVertexPositionBuffer.numItems = 12;

	        // COLOUR
	        that.pyramidVertexColorBuffer = gl.createBuffer();
		    gl.bindBuffer(gl.ARRAY_BUFFER, that.pyramidVertexColorBuffer);
		    var colors = [
		        // Front face
		        1.0, 0.0, 0.0, 1.0,
		        0.0, 1.0, 0.0, 1.0,
		        0.0, 0.0, 1.0, 1.0,
		        // Right face
		        1.0, 0.0, 0.0, 1.0,
		        0.0, 0.0, 1.0, 1.0,
		        0.0, 1.0, 0.0, 1.0,
		        // Back face
		        1.0, 0.0, 0.0, 1.0,
		        0.0, 1.0, 0.0, 1.0,
		        0.0, 0.0, 1.0, 1.0,
		        // Left face
		        1.0, 0.0, 0.0, 1.0,
		        0.0, 0.0, 1.0, 1.0,
		        0.0, 1.0, 0.0, 1.0
		    ];
		    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(colors), gl.STATIC_DRAW);
		    that.pyramidVertexColorBuffer.itemSize = 4;
		    that.pyramidVertexColorBuffer.numItems = 12;

	        that.cubeVertexPositionBuffer = gl.createBuffer();
	        gl.bindBuffer(gl.ARRAY_BUFFER, that.cubeVertexPositionBuffer);
	        vertices = [
		      // Front face
		      -1.0, -1.0,  1.0,
		       1.0, -1.0,  1.0,
		       1.0,  1.0,  1.0,
		      -1.0,  1.0,  1.0,

		      // Back face
		      -1.0, -1.0, -1.0,
		      -1.0,  1.0, -1.0,
		       1.0,  1.0, -1.0,
		       1.0, -1.0, -1.0,

		      // Top face
		      -1.0,  1.0, -1.0,
		      -1.0,  1.0,  1.0,
		       1.0,  1.0,  1.0,
		       1.0,  1.0, -1.0,

		      // Bottom face
		      -1.0, -1.0, -1.0,
		       1.0, -1.0, -1.0,
		       1.0, -1.0,  1.0,
		      -1.0, -1.0,  1.0,

		      // Right face
		       1.0, -1.0, -1.0,
		       1.0,  1.0, -1.0,
		       1.0,  1.0,  1.0,
		       1.0, -1.0,  1.0,

		      // Left face
		      -1.0, -1.0, -1.0,
		      -1.0, -1.0,  1.0,
		      -1.0,  1.0,  1.0,
		      -1.0,  1.0, -1.0,
		    ];
	        gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(vertices), gl.STATIC_DRAW);
	        that.cubeVertexPositionBuffer.itemSize = 3;
	        that.cubeVertexPositionBuffer.numItems = 24;

	        that.cubeVertexColorBuffer = gl.createBuffer();
		    gl.bindBuffer(gl.ARRAY_BUFFER, that.cubeVertexColorBuffer);
		    colors = [
		      [1.0, 0.0, 0.0, 1.0],     // Front face
		      [1.0, 1.0, 0.0, 1.0],     // Back face
		      [0.0, 1.0, 0.0, 1.0],     // Top face
		      [1.0, 0.5, 0.5, 1.0],     // Bottom face
		      [1.0, 0.0, 1.0, 1.0],     // Right face
		      [0.0, 0.0, 1.0, 1.0],     // Left face
		    ];
		    var unpackedColors = [];
		    for (var i in colors) {
		      var color = colors[i];
		      for (var j=0; j < 4; j++) {
		        unpackedColors = unpackedColors.concat(color);
		      }
		    }
		    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(unpackedColors), gl.STATIC_DRAW);
		    that.cubeVertexColorBuffer.itemSize = 4;
		    that.cubeVertexColorBuffer.numItems = 24;

		    that.cubeVertexIndexBuffer = gl.createBuffer();
		    gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, that.cubeVertexIndexBuffer);
		    var cubeVertexIndices = [
		      0, 1, 2,      0, 2, 3,    // Front face
		      4, 5, 6,      4, 6, 7,    // Back face
		      8, 9, 10,     8, 10, 11,  // Top face
		      12, 13, 14,   12, 14, 15, // Bottom face
		      16, 17, 18,   16, 18, 19, // Right face
		      20, 21, 22,   20, 22, 23  // Left face
		    ]
		    gl.bufferData(gl.ELEMENT_ARRAY_BUFFER, new Uint16Array(cubeVertexIndices), gl.STATIC_DRAW);
		    that.cubeVertexIndexBuffer.itemSize = 1;
		    that.cubeVertexIndexBuffer.numItems = 36;

		    cubeVertexTextureCoordBuffer = gl.createBuffer();
		    gl.bindBuffer(gl.ARRAY_BUFFER, cubeVertexTextureCoordBuffer);
		    var textureCoords = [
		      // Front face
		      0.0, 0.0,
		      1.0, 0.0,
		      1.0, 1.0,
		      0.0, 1.0,

		      // Back face
		      1.0, 0.0,
		      1.0, 1.0,
		      0.0, 1.0,
		      0.0, 0.0,

		      // Top face
		      0.0, 1.0,
		      0.0, 0.0,
		      1.0, 0.0,
		      1.0, 1.0,

		      // Bottom face
		      1.0, 1.0,
		      0.0, 1.0,
		      0.0, 0.0,
		      1.0, 0.0,

		      // Right face
		      1.0, 0.0,
		      1.0, 1.0,
		      0.0, 1.0,
		      0.0, 0.0,

		      // Left face
		      0.0, 0.0,
		      1.0, 0.0,
		      1.0, 1.0,
		      0.0, 1.0,
		    ];
		    gl.bufferData(gl.ARRAY_BUFFER, new Float32Array(textureCoords), gl.STATIC_DRAW);
		    cubeVertexTextureCoordBuffer.itemSize = 2;
		    cubeVertexTextureCoordBuffer.numItems = 24;
	  	}

	  	this.initTexture = function(gl) {
		    neheTexture = gl.createTexture();
		    neheTexture.image = new Image();
		    neheTexture.image.onload = function() {
		      handleLoadedTexture(neheTexture)
		    }

		    neheTexture.image.src = "nehe.gif";
	  	}

	  	this.handleLoadedTexture = function() {
	  		gl.bindTexture(gl.TEXTURE_2D, texture);
		    gl.pixelStorei(gl.UNPACK_FLIP_Y_WEBGL, true);
		    gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, texture.image);
		    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.NEAREST);
		    gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.NEAREST);
		    gl.bindTexture(gl.TEXTURE_2D, null);
	  	}

	  	this.drawScene = function(gl) {
	        gl.viewport(0, 0, that.gl.viewportWidth, that.gl.viewportHeight);
	        gl.clear(that.gl.COLOR_BUFFER_BIT | gl.DEPTH_BUFFER_BIT);

	        mat4.perspective(45, that.gl.viewportWidth / gl.viewportHeight, 0.1, 100.0, that.pMatrix);

	        mat4.identity(that.mvMatrix);


	        // cube
		    mat4.translate(mvMatrix, [0.0, 0.0, -5.0]);

		    mat4.rotate(mvMatrix, degToRad(xRot), [1, 0, 0]);
		    mat4.rotate(mvMatrix, degToRad(yRot), [0, 1, 0]);
		    mat4.rotate(mvMatrix, degToRad(zRot), [0, 0, 1]);

	        gl.bindBuffer(gl.ARRAY_BUFFER, that.cubeVertexPositionBuffer);
	        gl.vertexAttribPointer(that.shaderProgram.vertexPositionAttribute, that.cubeVertexPositionBuffer.itemSize, gl.FLOAT, false, 0, 0);

	        gl.bindBuffer(gl.ARRAY_BUFFER, that.cubeVertexColorBuffer);
    		gl.vertexAttribPointer(that.shaderProgram.vertexColorAttribute, that.cubeVertexColorBuffer.itemSize, gl.FLOAT, false, 0, 0);

			gl.bindBuffer(gl.ELEMENT_ARRAY_BUFFER, that.cubeVertexIndexBuffer);
	        that.setMatrixUniforms();
	        gl.drawElements(gl.TRIANGLES, that.cubeVertexIndexBuffer.numItems, gl.UNSIGNED_SHORT, 0);
	  	}

	  	this.setMatrixUniforms = function() {
	  		that.gl.uniformMatrix4fv(that.shaderProgram.pMatrixUniform, false, that.pMatrix);
        	that.gl.uniformMatrix4fv(that.shaderProgram.mvMatrixUniform, false, that.mvMatrix);
	  	}

	  	this.anim = function() {
			requestAnimFrame(that.anim)
		    that.drawScene(that.gl)
		    that.animate(that.gl)
	  	}

	  	this.animate = function() {
			var timeNow = new Date().getTime();
		    if (that.lastTime != 0) {
		      var elapsed = timeNow - that.lastTime;

		      that.rPyramid += (90 * elapsed) / 1000.0;
		      that.rCube += (75 * elapsed) / 1000.0;
		    }
		    that.lastTime = timeNow;
	  	}

	  	this.mvPushMatrix = function() {
			var copy = mat4.create();
		    mat4.set(that.mvMatrix, copy);
		    that.mvMatrixStack.push(copy);
		}

		this.mvPopMatrix = function() {
		    if (that.mvMatrixStack.length == 0) {
		      throw "Invalid popMatrix!";
		    }
		    that.mvMatrix = that.mvMatrixStack.pop();
		}

		this.degToRad = function(degrees) {
			return degrees * Math.PI / 180
		}
	}
}
