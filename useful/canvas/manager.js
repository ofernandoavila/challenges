class Manager {
    constructor() {
        this.isOnDown = false;
        this.canvas = document.querySelector("canvas#main");
        this.tool = new SelectTool();
    }

    SetLogMessage(message) {
        document.querySelector("p.output-message").innerHTML = message;
    }

    init() {
        document.querySelector("canvas#main").addEventListener("mousedown", (event) => {
            this.tool.onMouseDown(event);
        });
        
        document.querySelector("canvas#main").addEventListener("mousemove", (event) => {
            let coords = {
                x: event.clientX - document.querySelector("canvas#main").offsetLeft,
                y: event.clientY - document.querySelector("canvas#main").offsetTop
            };

            document.querySelector("p.coords").innerHTML = `(x: ${coords.x}, y: ${coords.y})`;

            this.tool.onMouseMove(event);
        });
        document.querySelector("canvas#main").addEventListener("mouseup", (event) => {
            this.tool.onMouseUp(event);
        });
    }

    changeTool(toolName) {
        this.SetLogMessage("Current tool: " + toolName);
        this.tool = null;
        
        switch (toolName) {
            case "SelectTool":
                this.tool = new SelectTool(this.canvas);
                break;

            case "ShapeTool":
                this.tool = new ShapeTool(this.canvas);
                break;
        }
    }
}

const manager = new Manager();

manager.init();