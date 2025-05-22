import './bootstrap';
import Alpine from 'alpinejs';
import intersect from '@alpinejs/intersect';
import scrollHandler from './components/scrollHandler'; 
Alpine.plugin(intersect);

window.Alpine = Alpine;
window.scrollHandler = scrollHandler;

Alpine.start();