let tools = document.querySelectorAll(".toolbar button");

tools.forEach((item) => {
    switch (item.value) {
        case "cursor-pointer":
            item.addEventListener("click", () => manager.changeTool("SelectTool"));
            break;

        case "draw-square":
            item.addEventListener("click", () => manager.changeTool("ShapeTool"));
            break;
    }
});
