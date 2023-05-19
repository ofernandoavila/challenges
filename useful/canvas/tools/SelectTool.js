class SelectTool {
    constructor() {
        this.name = "Selection Tool";
        this.isMouseDown = false;
    }

    onMouseDown() {
        this.isMouseDown = true;
        console.log('Select Tool mouse down');
    }

    onMouseUp() {
        this.isMouseDown = false;
        console.log('Select Tool mouse up');
    }

    onMouseMove() {
        if(!this.isMouseDown) return;
        console.log('Select Tool mouse move');
    }
}