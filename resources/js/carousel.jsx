import React from 'react';
import ReactDOM from 'react-dom/client';
import RollingGallery from './components/carrousel/RollingGallery';

const root = document.getElementById('app');
if (root) {
    ReactDOM.createRoot(root).render(
        <React.StrictMode>
            <RollingGallery autoplay={true} pauseOnHover={true} />
        </React.StrictMode>
    );
}