import React from "react";
import { createRoot } from "react-dom/client";
import Aurora from "./components/Aurora";

const root = document.getElementById("aurora-root");
if (root) {
    createRoot(root).render(
        <React.StrictMode>
            <Aurora />
        </React.StrictMode>
    );
}