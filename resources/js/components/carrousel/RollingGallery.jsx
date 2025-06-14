import { useEffect, useRef, useState } from "react";
import { motion, useMotionValue, useAnimation, useTransform } from "framer-motion";
import "./RollingGallery.css";

const IMGS = [
  "/img/carousel/1.jpg",
  "/img/carousel/2.jpg",
  "/img/carousel/3.jpg",
  "/img/carousel/4.jpg",
  "/img/carousel/5.jpg",
  "/img/carousel/6.png",
  "/img/carousel/7.png",
  "/img/carousel/8.png",
  "/img/carousel/9.jpeg",
  "/img/carousel/10.jpg",
];


const RollingGallery = ({ autoplay = false, pauseOnHover = false, images = [] }) => {
  images = IMGS;
  const [isScreenSizeSm, setIsScreenSizeSm] = useState(window.innerWidth <= 640);

  const cylinderWidth = isScreenSizeSm ? 1100 : 1800;
  const faceCount = images.length;
  const faceWidth = (cylinderWidth / faceCount) * 1.5;
  const dragFactor = 0.02; // Reduced drag factor for smoother dragging
  const radius = cylinderWidth / (1.5 * Math.PI);

  const rotation = useMotionValue(0);
  const controls = useAnimation();
  const autoplayRef = useRef();

  const handleDrag = (_, info) => {
    rotation.set(rotation.get() + info.offset.x * dragFactor);
  };

  const handleDragEnd = (_, info) => {
    controls.start({
      rotateY: rotation.get() + info.velocity.x * dragFactor,
      transition: { type: "spring", stiffness: 40, damping: 15, mass: 0.1, ease: "easeOut" }, // Softer spring animation
    });
  };

  const transform = useTransform(rotation, (value) => {
    return `rotate3d(0, 1, 0, ${value}deg)`;
  });

  // Optimized autoplay using requestAnimationFrame
  useEffect(() => {
    let animationFrameId;

    const autoplayAnimation = () => {
      controls.start({
        rotateY: rotation.get() - (0.5 / faceCount),
        transition: { duration: 2.5, ease: "linear" }, // Slightly slower and smoother
      });
      rotation.set(rotation.get() - (0.5 / faceCount));
      animationFrameId = requestAnimationFrame(autoplayAnimation);
    };

    if (autoplay) {
      autoplayAnimation();
    }

    return () => cancelAnimationFrame(animationFrameId);
  }, [autoplay, rotation, controls, faceCount]);

  useEffect(() => {
    const handleResize = () => {
      setIsScreenSizeSm(window.innerWidth <= 640);
    };

    window.addEventListener("resize", handleResize);
    return () => window.removeEventListener("resize", handleResize);
  }, []);

  const handleMouseEnter = () => {
    if (autoplay && pauseOnHover) {
      cancelAnimationFrame(autoplayRef.current);
      controls.stop();
    }
  };

  const handleMouseLeave = () => {
    if (autoplay && pauseOnHover) {
      autoplayRef.current = requestAnimationFrame(() => {
        controls.start({
          rotateY: rotation.get() - (0.5 / faceCount),
          transition: { duration: 1, ease: "linear" },
        });
        rotation.set(rotation.get() - (0.5 / faceCount));
      });
    }
  };

  return (
    <div className="gallery-container">
      <div className="gallery-gradient gallery-gradient-left"></div>
      <div className="gallery-gradient gallery-gradient-right"></div>
      <div className="gallery-content">
        <motion.div
          drag="x"
          className="gallery-track"
          onMouseEnter={handleMouseEnter}
          onMouseLeave={handleMouseLeave}
          style={{
            transform: transform,
            rotateY: rotation,
            width: cylinderWidth,
            transformStyle: "preserve-3d",
          }}
          onDrag={handleDrag}
          onDragEnd={handleDragEnd}
          animate={controls}
        >
          {images.map((url, i) => (
            <div
              key={i}
              className="gallery-item"
              style={{
                width: `${faceWidth}px`,
                transform: `rotateY(${i * (360 / faceCount)}deg) translateZ(${radius}px)`,
              }}
            >
              <img src={url} alt="gallery" className="gallery-img" />
            </div>
          ))}
        </motion.div>
      </div>
    </div>
  );
};

export default RollingGallery;