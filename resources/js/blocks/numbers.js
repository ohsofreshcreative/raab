import gsap from 'gsap';

const DEFAULT_DURATION = 2;

/**
 * Extracts one numeric token from a string and keeps prefix/suffix.
 * Supports formats like: 1200, 12.5, 12,5, 1200+
 */
function parseAnimatedNumber(rawValue) {
  const value = String(rawValue ?? '').trim();
  const match = value.match(/-?\d+(?:[.,]\d+)?/);

  if (!match || typeof match.index === 'undefined') {
    return null;
  }

  const numericToken = match[0];
  const numericValue = Number.parseFloat(numericToken.replace(',', '.'));
  if (Number.isNaN(numericValue)) {
    return null;
  }

  const decimalPart = numericToken.split(/[.,]/)[1] ?? '';

  return {
    prefix: value.slice(0, match.index),
    suffix: value.slice(match.index + numericToken.length),
    numericValue,
    decimals: decimalPart.length,
  };
}

function formatNumber(value, decimals) {
  if (decimals > 0) {
    return value.toFixed(decimals).replace('.', ',');
  }

  return String(Math.round(value));
}

/**
 * Animates a single number container with a robust count-up effect.
 * @param {HTMLElement} container The container element with a data-number attribute.
 */
function animateNumber(container) {
  const rawValue = container.dataset.number;
  if (typeof rawValue === 'undefined') {
    return;
  }

  const parsed = parseAnimatedNumber(rawValue);
  if (!parsed) {
    container.textContent = rawValue;
    return;
  }

  const state = { value: 0 };

  gsap.to(state, {
    value: parsed.numericValue,
    duration: DEFAULT_DURATION,
    ease: 'power2.out',
    onUpdate: () => {
      const shownValue = formatNumber(state.value, parsed.decimals);
      container.textContent = `${parsed.prefix}${shownValue}${parsed.suffix}`;
    },
    onComplete: () => {
      container.textContent = `${parsed.prefix}${formatNumber(parsed.numericValue, parsed.decimals)}${parsed.suffix}`;
    },
  });
}

function initNumbers() {
  const numberContainers = document.querySelectorAll('.number-container');
  if (!numberContainers.length) {
    return;
  }

  // Prevent re-animation on viewport/orientation changes.
  const animated = new WeakSet();

  if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (!entry.isIntersecting) {
            return;
          }

          const container = entry.target;
          if (animated.has(container)) {
            observer.unobserve(container);
            return;
          }

          animated.add(container);
          animateNumber(container);
          observer.unobserve(container);
        });
      },
      {
        threshold: 0.25,
        rootMargin: '0px 0px -10% 0px',
      }
    );

    numberContainers.forEach((container) => observer.observe(container));
    return;
  }

  // Fallback for older browsers.
  numberContainers.forEach((container) => animateNumber(container));
}

if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', initNumbers);
} else {
  initNumbers();
}
