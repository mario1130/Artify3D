import React from "react";
import { createRoot } from "react-dom/client";
import Particles from "./components/Particles";

const root = document.getElementById("particles-root");
if (root) {
  createRoot(root).render(
    <React.StrictMode>
      <Particles
        particleCount={300}
        particleSpread={10}
        speed={0.1}
        particleColors={["#ffffff"]}
        alphaParticles={true}
        particleBaseSize={100}
        sizeRandomness={1}
        cameraDistance={10}
        disableRotation={false}
        className=""
      />
    </React.StrictMode>
  );
}