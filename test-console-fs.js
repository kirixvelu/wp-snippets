// snippet for browser console to display computed font sizes for all heading on current page. Source: https://brndle.com/fluid-typography-spacing-theme-json/
document.querySelectorAll("h1, h2, h3, h4, h5, h6").forEach((el) => {
  const computed = window.getComputedStyle(el);
  console.log(
    `${el.tagName}: ${computed.fontSize} (${parseFloat(computed.fontSize) / 16}rem)`,
    `| line-height: ${computed.lineHeight}`,
    `| text: "${el.textContent.substring(0, 40)}..."`,
  );
});
