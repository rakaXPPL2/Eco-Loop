import React from 'react';
import { createRoot } from 'react-dom/client';
import LandingPage from './components/LandingPage';

// Import landing page styles
import './components/landing.css';

const container = document.getElementById('landing-root');
if (container) {
  const root = createRoot(container);
  root.render(<LandingPage />);
}
