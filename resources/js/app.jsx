import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import LandingArtify3D from './pages/LandingArtify3D';
import RollingGallery from './components/carrousel/RollingGallery';

const root = document.getElementById('app');

if (root) {
    ReactDOM.createRoot(root).render(
        <React.StrictMode>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<LandingArtify3D />} />
                    <Route path="/galeria" element={<RollingGallery autoplay={true} pauseOnHover={true} />} />
                </Routes>
            </BrowserRouter>
        </React.StrictMode>
    );
}