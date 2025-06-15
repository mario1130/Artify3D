import React, { useRef, useEffect } from "react";
import { motion, useAnimation } from "framer-motion";
import "./ImageCarousel.css";

const images = [
  "/img/carousel/1.jpg",
  "/img/carousel/2.jpg",
  "/img/carousel/3.jpg",
  "/img/carousel/4.jpg",
  "/img/carousel/5.jpg",
];

export default function ImageCarousel() {
  const controls = useAnimation();
  const carouselRef = useRef(null);

  // Duplicamos las imágenes para efecto infinito
  const infiniteImages = [...images, ...images];

  // Ancho de cada imagen (igual que en el CSS)
  const imgWidth = 400 + 24; // min-width + gap

  useEffect(() => {
    let x = 0;
    let frame;
    const totalWidth = imgWidth * images.length;

    function animate() {
      x -= 1.2; // velocidad
      if (Math.abs(x) >= totalWidth) x = 0;
      controls.set({ x });
      frame = requestAnimationFrame(animate);
    }
    animate();
    return () => cancelAnimationFrame(frame);
  }, [controls]);

  return (
    <div className="carousel-outer" ref={carouselRef}>
      <motion.div
        className="carousel-inner"
        animate={controls}
        style={{
          display: "flex",
          gap: 24,
          cursor: "grab",
        }}
      >
        {infiniteImages.map((src, i) => (
          <motion.div
            className="carousel-img-wrap"
            key={i}
            whileHover={{ scale: 1.04, boxShadow: "0 4px 32px #1D712940" }}
          >
            <img src={src} alt={`carousel-${i % images.length}`} className="carousel-img" />
          </motion.div>
        ))}
      </motion.div>
    </div>
  );
}