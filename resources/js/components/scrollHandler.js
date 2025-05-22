export default function scrollHandler() {
    return {
        activeSection: '',
        sectionIds: ['services', 'about', 'contact'],
        scrollTo(id) {
            const el = document.getElementById(id);
            if (el) {
                const yOffset = (window.innerHeight / 2) - (el.offsetHeight / 2);
                window.scrollTo({
                    top: el.offsetTop - yOffset,
                    behavior: 'smooth'
                });
            }
        },
        init() {
            this.onScroll();
        },
        onScroll() {
            const fromTop = window.scrollY + window.innerHeight / 2;
            for (let id of this.sectionIds) {
                const el = document.getElementById(id);
                if (el) {
                    const top = el.offsetTop;
                    const bottom = top + el.offsetHeight;
                    if (fromTop >= top && fromTop <= bottom) {
                        this.activeSection = id;
                        break;
                    }
                }
            }
        }
    }
}
