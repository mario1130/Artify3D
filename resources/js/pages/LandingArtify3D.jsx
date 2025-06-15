import React, { useState } from "react";
import ScrollFloat from "../components/ScrollFloat";
import ImageCarousel from "../components/ImageCarousel";
import Aurora from "../components/Aurora";
import Particles from "../components/Particles";
import "../components/ScrollFloat.css";
import "../components/ImageCarousel.css";
import { motion, useScroll, useTransform, useMotionValueEvent } from "framer-motion";

// Mock productos
const products = [
  {
    name: "Pack Modelos Blender",
    img: "/img/Logo.png",
    price: "15€",
  },
  {
    name: "Gadget Maker",
    img: "/img/Logo.png",
    price: "29€",
  },
  {
    name: "Curso Blender Básico",
    img: "/img/Logo.png",
    price: "49€",
  },
];

const fadeUp = {
  hidden: { opacity: 0, y: 40 },
  show: (i = 0) => ({
    opacity: 1,
    y: 0,
    transition: { delay: i * 0.15, duration: 0.7, type: "spring" },
  }),
};

export default function LandingArtify3D() {
  const { scrollY } = useScroll();
  // Animación del hero
  const scale = useTransform(scrollY, [0, 220], [1, 0.45]);
  const x = useTransform(scrollY, [0, 220], [0, 30]);
  const y = useTransform(scrollY, [0, 220], [0, -30]);
  // Visibilidad del sticky header
  const stickyBg = useTransform(scrollY, [0, 220], ["rgba(16,16,16,0)", "rgba(16,16,16,0.97)"]);
  const showSticky = useTransform(scrollY, [180, 220], [0, 1]);
  // Visibilidad del hero (desaparece cuando sticky aparece)
  const showHero = useTransform(scrollY, [170, 200], [1, 0]);

  // Mostrar/ocultar triángulo según scroll
  const [showTriangle, setShowTriangle] = useState(true);
  useMotionValueEvent(scrollY, "change", (latest) => {
    setShowTriangle(latest < 40);
  });

  // Scroll suave al siguiente bloque (ScrollFloat)
  const scrollToNext = () => {
    const next = document.getElementById("scrollfloat-section");
    if (next) {
      const y = next.getBoundingClientRect().top + window.scrollY - 150;
      window.scrollTo({ top: y, behavior: "smooth" });
    }
  };

  // Estado para mostrar/ocultar partículas
  const [showParticles, setShowParticles] = useState(true);

  return (
    <>
      {/* Responsive styles */}
      <style>
        {`
          .hero-flex {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
          }
          .hero-left {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
            padding-left: 8vw;
            min-width: 0;
          }
          .hero-img {
            width: 80%;
            max-width: 480px;
            border-radius: 18px;
            object-fit: cover;
          }
          .triangle-btn {
            cursor: pointer;
            background: rgba(24,24,24,0.92);
            border-radius: 50%;
            width: 54px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: width 0.2s, height 0.2s;
          }
          @media (max-width: 900px) {
            .hero-flex {
              flex-direction: column !important;
              padding-left: 0 !important;
            }
            .hero-left {
              align-items: center !important;
              padding-left: 0 !important;
              width: 100% !important;
            }
            .hero-img {
              width: 90% !important;
              max-width: 320px !important;
              margin-top: 32px !important;
            }
          }
          @media (max-width: 600px) {
            .hero-left h1 {
              font-size: 2.2rem !important;
            }
            .hero-left {
              padding: 0 8vw !important;
            }
            .triangle-btn {
              width: 44px !important;
              height: 44px !important;
            }
          }
        `}
      </style>
      <div style={{ background: "#101010", color: "#f0f0f0", minHeight: "100vh", position: "relative", overflow: "hidden" }}>
        {/* Aurora background */}
        <div
          style={{
            position: "absolute",
            top: 0,
            left: 0,
            width: "100vw",
            height: "100vh",
            zIndex: 0,
            pointerEvents: "none",
          }}
        >
          <Aurora
            colorStops={["#5227FF", "#7cff67", "#5227FF"]}
            amplitude={1.0}
            blend={0.5}
          />
        </div>

        {/* Partículas en TODO el fondo */}
        {showParticles && (
          <div
            style={{
              position: "fixed",
              top: 0,
              left: 0,
              width: "100vw",
              height: "100vh",
              zIndex: 0,
              pointerEvents: "none",
            }}
          >
            <Particles
              particleCount={400}
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
          </div>
        )}
        {/* Sticky header SOLO cuando el hero es pequeño */}
        <motion.div
          style={{
            position: "fixed",
            top: 0,
            left: 0,
            width: "100vw",
            zIndex: 20,
            pointerEvents: "none",
            background: stickyBg,
            height: 90,
            display: "flex",
            alignItems: "center",
            paddingLeft: 32,
            paddingTop: 10,
            gap: 18,
            opacity: showSticky,
          }}
        >
          <div
            style={{
              display: "flex",
              alignItems: "center",
              gap: 16,
            }}
          >
            <span
              style={{
                fontSize: "2.1rem",
                fontWeight: 700,
                color: "#fff",
                letterSpacing: "-2px",
                marginRight: 10,
                pointerEvents: "auto",
              }}
            >
              Artify3D
            </span>
          </div>
        </motion.div>

        {/* HERO: Izquierda texto, derecha imagen */}
        <motion.section
          style={{
            minHeight: "100vh",
            display: "flex",
            flexDirection: "column",
            alignItems: "center",
            justifyContent: "center",
            padding: "0 0 60px 0",
            gap: 0,
            opacity: showHero,
            pointerEvents: showHero,
            position: "relative",
            zIndex: 1,
            scale,
            y,
            originY: 0,
          }}
        >
          <div className="hero-flex">
            {/* Izquierda: nombre y subtítulo, ambos animados */}
            <motion.div
              className="hero-left"
              style={{
                flex: 1,
                display: "flex",
                flexDirection: "column",
                alignItems: "flex-start",
                justifyContent: "center",
                paddingLeft: "8vw",
                minWidth: 0,
                scale,
                x,
                y,
                originX: 0,
                originY: 0,
              }}
            >
              <motion.h1
                initial={{ opacity: 0, x: -60 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 1 }}
                style={{
                  fontSize: "5vw",
                  fontWeight: 800,
                  marginBottom: 18,
                  letterSpacing: "-2px",
                  color: "#fff",
                  lineHeight: 1.1,
                  whiteSpace: "pre-line",
                }}
              >
                Artify3D
              </motion.h1>
              <motion.div
                initial={{ opacity: 0, x: -60 }}
                animate={{ opacity: 1, x: 0 }}
                transition={{ duration: 1, delay: 0.2 }}
                style={{
                  fontSize: "1.5rem",
                  color: "#bdbdbd",
                  marginBottom: 38,
                  fontWeight: 400,
                  maxWidth: 420,
                }}
              >
                La tienda oficial.<br />
                Modelos 3D, gadgets y tecnología para creadores y entusiastas.
              </motion.div>
              <div style={{ display: "flex", gap: 12 }}>
                <motion.a
                  href="/search"
                  whileHover={{ scale: 1.06, background: "linear-gradient(90deg, #1D7129 60%, #1D7129 100%)" }}
                  style={{
                    background: "linear-gradient(90deg, #1D7129 60%, #1D7129 100%)",
                    color: "#fff",
                    border: "none",
                    borderRadius: 8,
                    padding: "18px 44px",
                    fontSize: "1.15rem",
                    fontWeight: 600,
                    letterSpacing: "1px",
                    cursor: "pointer",
                    boxShadow: "0 2px 16px #1D712955",
                    textDecoration: "none",
                    marginBottom: 24,
                    display: "inline-block",
                    transition: "background 0.2s, transform 0.2s",
                  }}
                >
                  Explorar Productos
                </motion.a>
                <button
                  style={{
                    background: "#232323",
                    color: "#fff",
                    border: "none",
                    borderRadius: 8,
                    padding: "18px 24px",
                    fontSize: "1.05rem",
                    fontWeight: 500,
                    cursor: "pointer",
                    marginBottom: 24,
                    transition: "background 0.2s",
                  }}
                  onClick={() => setShowParticles((v) => !v)}
                >
                  {showParticles ? "Ocultar partículas" : "Mostrar partículas"}
                </button>
              </div>
            </motion.div>
            {/* Derecha: imagen */}
            <div
              style={{
                flex: 1,
                display: "flex",
                alignItems: "center",
                justifyContent: "center",
                minWidth: 0,
              }}
            >
              <motion.img
                className="hero-img"
                initial={{ opacity: 0, x: 60, y: 60 }}
                animate={{ opacity: 1, x: 0, y: 0 }}
                transition={{ duration: 1 }}
                src="/img/Logo.png"
                alt="Hero Artify3D"
                style={{
                  width: "80%",
                  maxWidth: 480,
                  borderRadius: "18px",
                  objectFit: "cover",
                }}
              />
            </div>
          </div>
        </motion.section>

        {/* Botón/triángulo fijo abajo, solo visible arriba */}
        {showTriangle && (
          <div
            style={{
              position: "fixed",
              left: 0,
              bottom: 0,
              width: "100vw",
              display: "flex",
              justifyContent: "center",
              zIndex: 50,
              pointerEvents: "none",
            }}
          >
            <motion.div
              className="triangle-btn"
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              exit={{ opacity: 0, y: 20 }}
              transition={{ delay: 0.1, duration: 0.5, type: "spring" }}
              style={{
                pointerEvents: "auto",
                margin: "16px 0",
              }}
              onClick={scrollToNext}
              title="Bajar"
            >
              <motion.svg
                width="32"
                height="32"
                viewBox="0 0 32 32"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                initial={{ y: 0 }}
                animate={{ y: [0, 10, 0] }}
                transition={{ repeat: Infinity, duration: 1.6, ease: "easeInOut" }}
              >
                <polygon points="16,24 6,12 26,12" fill="#1D7129" />
              </motion.svg>
            </motion.div>
          </div>
        )}

        {/* SCROLLFLOAT animado debajo del hero */}
        <div id="scrollfloat-section" style={{ display: "flex", justifyContent: "center", margin: "40px 0" }}>
          <ScrollFloat>
            Dale vida a tus ideas en 3D con Artify3D
          </ScrollFloat>
        </div>

        {/* Carrusel de imágenes animado */}
        <ImageCarousel />

        {/* Testimonios animados */}
        <motion.section
          initial="hidden"
          whileInView="show"
          variants={{
            hidden: {},
            show: { transition: { staggerChildren: 0.18 } },
          }}
          style={{
            maxWidth: 900,
            margin: "0 auto 60px auto",
            padding: "0 20px",
          }}
        >
          <motion.h2
            variants={fadeUp}
            style={{
              fontSize: "2rem",
              fontWeight: 700,
              marginBottom: 32,
              color: "#fff",
              textAlign: "center",
            }}
          >
            Lo que dicen nuestros clientes
          </motion.h2>
          <div
            style={{
              display: "flex",
              flexWrap: "wrap",
              gap: 32,
              justifyContent: "center",
            }}
          >
            {[
              {
                name: "Ana Torres",
                avatar: "/img/caras/1.jpg",
                text: "¡Los modelos 3D son de altísima calidad y el soporte es excelente!",
              },
              {
                name: "Carlos Méndez",
                avatar: "/img/caras/2.jpg",
                text: "El envío fue rapidísimo y el gadget Maker superó mis expectativas.",
              },
              {
                name: "Lucía Fernández",
                avatar: "/img/caras/3.jpg",
                text: "El curso de Blender me ayudó a empezar en el mundo 3D. ¡Gracias Artify3D!",
              },
            ].map((t, i) => (
              <motion.div
                key={i}
                variants={fadeUp}
                whileHover={{
                  scale: 1.04,
                  boxShadow: "0 4px 32px #1D712940",
                  borderColor: "#1D7129",
                }}
                style={{
                  background: "#181818",
                  borderRadius: 14,
                  boxShadow: "0 2px 16px #0003",
                  padding: "28px 22px",
                  minWidth: 260,
                  maxWidth: 320,
                  flex: "1 1 260px",
                  display: "flex",
                  flexDirection: "column",
                  alignItems: "center",
                  border: "1px solid #232323",
                  transition: "box-shadow 0.2s, transform 0.2s, border-color 0.2s",
                }}
              >
                <motion.img
                  src={t.avatar}
                  alt={t.name}
                  initial={{ opacity: 0, scale: 0.8 }}
                  whileInView={{ opacity: 1, scale: 1 }}
                  transition={{ duration: 0.6, delay: 0.2 + i * 0.1, type: "spring" }}
                  style={{
                    width: 64,
                    height: 64,
                    borderRadius: "50%",
                    marginBottom: 14,
                    objectFit: "cover",
                    border: "2px solid #1D7129",
                    background: "#222",
                    overflow: "hidden",
                  }}
                />
                <motion.div
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.5, delay: 0.3 + i * 0.1 }}
                  style={{ color: "#fff", fontWeight: 600, marginBottom: 8 }}
                >
                  {t.name}
                </motion.div>
                <motion.div
                  initial={{ opacity: 0, y: 20 }}
                  whileInView={{ opacity: 1, y: 0 }}
                  transition={{ duration: 0.5, delay: 0.4 + i * 0.1 }}
                  style={{ color: "#bdbdbd", fontSize: "1.05rem", textAlign: "center" }}
                >
                  {t.text}
                </motion.div>
              </motion.div>
            ))}
          </div>
        </motion.section>

        {/* CTA animada */}
        <motion.section
          initial={{ opacity: 0, y: 60 }}
          whileInView={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.8, type: "spring" }}
          style={{
            maxWidth: 700,
            margin: "0 auto 60px auto",
            padding: "40px 24px",
            background: "linear-gradient(90deg, #232323 60%, #1D7129 100%)",
            borderRadius: 18,
            textAlign: "center",
          }}
        >
          <motion.h2
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, type: "spring" }}
            style={{ color: "#fff", fontSize: "2rem", fontWeight: 700, marginBottom: 18 }}
          >
            ¿Listo para llevar tus ideas al siguiente nivel?
          </motion.h2>
          <motion.p
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, delay: 0.2, type: "spring" }}
            style={{ color: "#bdbdbd", fontSize: "1.15rem", marginBottom: 28 }}
          >
            Únete a la comunidad de creadores y accede a recursos exclusivos, soporte y mucho más.
          </motion.p>
          <motion.a
            href="/search"
            whileHover={{ scale: 1.07, background: "linear-gradient(90deg, #1D7129 60%, #1D7129 100%)" }}
            initial={{ opacity: 0, y: 30 }}
            whileInView={{ opacity: 1, y: 0 }}
            transition={{ duration: 0.7, delay: 0.4, type: "spring" }}
            style={{
              background: "linear-gradient(90deg, #1D7129 60%, #1D7129 100%)",
              color: "#fff",
              border: "none",
              borderRadius: 8,
              padding: "18px 44px",
              fontSize: "1.15rem",
              fontWeight: 600,
              letterSpacing: "1px",
              cursor: "pointer",
              boxShadow: "0 2px 16px #1D712955",
              textDecoration: "none",
              display: "inline-block",
              transition: "background 0.2s, transform 0.2s",
            }}
          >
            Explorar Productos
          </motion.a>
        </motion.section>

        {/* GALERÍA DE PRODUCTOS */}
        <motion.section
          initial="hidden"
          whileInView="show"
          variants={{
            hidden: {},
            show: { transition: { staggerChildren: 0.12 } },
          }}
          style={{
            maxWidth: 1100,
            margin: "0 auto 60px auto",
            padding: "0 20px",
          }}
        >
          <motion.h2
            variants={fadeUp}
            style={{
              marginTop: "11rem",
              fontSize: "2.1rem",
              fontWeight: 700,
              marginBottom: 32,
              color: "#fff",
              textAlign: "center",
            }}
          >
            Productos destacados
          </motion.h2>
          <div
            style={{
              display: "flex",
              flexWrap: "wrap",
              gap: 32,
              justifyContent: "center",
            }}
          >
            {products.map((p, i) => (
              <motion.div
                key={i}
                variants={fadeUp}
                whileHover={{
                  scale: 1.04,
                  boxShadow: "0 4px 32px #1D712940",
                  borderColor: "#1D7129",
                }}
                style={{
                  background: "#181818",
                  borderRadius: 14,
                  boxShadow: "0 2px 16px #0003",
                  padding: "24px 18px",
                  minWidth: 220,
                  maxWidth: 260,
                  flex: "1 1 220px",
                  display: "flex",
                  flexDirection: "column",
                  alignItems: "center",
                  border: "1px solid #232323",
                  transition: "box-shadow 0.2s, transform 0.2s, border-color 0.2s",
                }}
              >
                <img
                  src={p.img}
                  alt={p.name}
                  style={{
                    width: "100%",
                    height: 120,
                    objectFit: "contain",
                    marginBottom: 18,
                    borderRadius: 8,
                    background: "#222",
                  }}
                />
                <div style={{ fontWeight: 600, fontSize: "1.1rem", marginBottom: 8 }}>{p.name}</div>
                <div style={{ color: "#1D7129", fontWeight: 700, fontSize: "1.05rem" }}>{p.price}</div>
                <a
                  href="/search"
                  style={{
                    marginTop: 14,
                    background: "#1D7129",
                    color: "#fff",
                    border: "none",
                    borderRadius: 6,
                    padding: "8px 20px",
                    fontSize: "1em",
                    fontWeight: 500,
                    textDecoration: "none",
                    transition: "background 0.2s",
                    display: "inline-block",
                  }}
                >
                  Ver más
                </a>
              </motion.div>
            ))}
          </div>
        </motion.section>

        {/* SOBRE ARTIFY3D */}
        <motion.section
          initial="hidden"
          whileInView="show"
          variants={fadeUp}
          style={{
            maxWidth: 900,
            margin: "0 auto 60px auto",
            padding: "0 20px",
            textAlign: "center",
          }}
        >
          <motion.h2
            variants={fadeUp}
            style={{
              fontSize: "2.1rem",
              fontWeight: 700,
              marginBottom: 18,
              color: "#fff",
            }}
          >
            ¿Qué es Artify3D?
          </motion.h2>
          <motion.p
            variants={fadeUp}
            style={{
              fontSize: "1.15rem",
              color: "#bdbdbd",
              marginBottom: 0,
              lineHeight: 1.7,
            }}
          >
            Artify3D es la tienda oficial de Artify3D, donde encontrarás modelos 3D, gadgets y recursos para creadores digitales. Nuestra misión es acercar la tecnología y el diseño 3D a todos los entusiastas y profesionales, con productos seleccionados y soporte directo.
          </motion.p>
        </motion.section>
      </div>
    </>
  );
}