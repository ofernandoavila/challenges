class ShapeTool {
    constructor(canvas) {
        this.name = "Shape Tool";
        this.isMouseDown = false;
        this.startPoint = {};
        this.endPoint = {};
        this.shapes = [];
        this.canvas = canvas;
        this.context = canvas.getContext('2d');
    }

    onMouseDown(event) {
        this.isMouseDown = true;
        this.startPoint = {
            x: event.clientX - this.canvas.offsetLeft,
            y: event.clientY - this.canvas.offsetTop
        }
    }

    onMouseUp(event) {
        document.querySelector("canvas#main").width = document.querySelector("canvas#main").width;

        this.isMouseDown = false;

        this.shapes.push({
            x: this.startPoint.x,
            y: this.startPoint.y,
            x2: this.endPoint.x,
            y2: this.endPoint.y
        });

        this.drawShapes();
    }

    onMouseMove(event) {
        if(!this.isMouseDown) return;

        this.endPoint = {
            x: event.clientX - this.canvas.offsetLeft,
            y: event.clientY - this.canvas.offsetTop
        };

        this.context.beginPath();
        this.context.fillRect(
            this.startPoint.x, 
            this.startPoint.y, 
            this.endPoint.x - this.startPoint.x, 
            this.endPoint.y - this.startPoint.y
        );
    }
    
    drawShapes() {
        this.shapes.map( shape => {
            this.context.beginPath();
            this.context.fillRect(
                shape.x, 
                shape.y, 
                shape.x2 - shape.x, 
                shape.y2 - shape.y
            );
        });
    }
}