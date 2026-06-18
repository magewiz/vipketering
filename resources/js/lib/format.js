// Build a tel: href from a Macedonian display number.
// "078 226 005" -> "tel:+38978226005" (strip spaces, drop a leading 0, prefix +389)
export function telHref(num) {
    if (!num) return '#';
    const digits = String(num).replace(/\D/g, '').replace(/^0/, '');
    return `tel:+389${digits}`;
}

// Map a gallery aspect hint to a Tailwind aspect-ratio class.
export function aspectClass(aspect) {
    switch (aspect) {
        case '3/4': return 'aspect-[3/4]';
        case '4/5': return 'aspect-[4/5]';
        case '16/10': return 'aspect-[16/10]';
        case 'square':
        default: return 'aspect-square';
    }
}
