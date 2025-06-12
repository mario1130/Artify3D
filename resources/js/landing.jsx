import React from 'react';
import ReactDOM from 'react-dom/client';
import LandingArtify3D from './pages/LandingArtify3D';

const root = document.getElementById('app');
if (root) {
    ReactDOM.createRoot(root).render(
        <React.StrictMode>
            <LandingArtify3D />
        </React.StrictMode>
    );
}