export default function buildEditor() {
  const stage = new Konva.Stage({
    container: 'editor',
    height: 842,
    width: 595,
  });
  stage.container().style.backgroundColor = '#fffefb';

  const layer = new Konva.Layer();
  stage.add(layer);

  // Variable to control the position of the new text elements
  let textYPosition = 50;

  // Editor buttons
  const addTextBtn = document.querySelector('[data-button="add-text"]');
  const deleteTextBtn = document.querySelector('[data-button="delete"]');
  const dlJSONBtn = document.querySelector('[data-button="dl-json"]');
  const dlPDFBtn = document.querySelector('[data-button="dl-pdf"]');

  // Event listeners
  addTextBtn.addEventListener('click', () => {
    addNewTextElement(stage, layer, textYPosition);
    textYPosition += 50;
  });
  deleteTextBtn.addEventListener('click', () => {
    deleteAllText(stage);
    textYPosition = 50;
  });
  dlJSONBtn.addEventListener('click', () => downloadAsJSON(stage));
  dlPDFBtn.addEventListener('click', () => downloadAsPDF(stage));
}

function addNewTextElement(stage, layer, textYPosition) {
  const text = new Konva.Text({
    x: 50,
    y: textYPosition,
    fontFamily: 'Tahoma',
    fontSize: 18,
    fill: '#3b3c3d',
    lineHeight: 1.2,
    width: 500,
    text: 'Doble click para editar',
    draggable: true,
  });

  layer.add(text);
  layer.draw();

  // Text node events
  text.on('dblclick', () => enterText(text, stage));
  text.on('click', () => {
    setTimeout(() => boldText(text), 200);
  });
}

function enterText(text, stage) {
  const textPosition = text.getAbsolutePosition();
  const stagePosition = stage.container().getBoundingClientRect();

  // Text input area creation
  const textArea = document.createElement('textarea');
  document.body.appendChild(textArea);

  // Reset text node
  text.text('');

  // Text area styles
  textArea.style.position = 'absolute';
  textArea.style.left = stagePosition.left + textPosition.x + 'px';
  textArea.style.top = stagePosition.top + textPosition.y + 'px';
  textArea.style.backgroundColor = 'transparent';
  textArea.style.border = 'none';
  textArea.style.outline = 'none';
  textArea.style.resize = 'none';
  textArea.style.color = '#3b3c3d';
  textArea.style.fontFamily = text.fontFamily();
  textArea.style.fontSize = text.fontSize() + 'px';
  textArea.style.width = text.width() + 'px';
  textArea.style.height = 'auto';
  textArea.value = text.text();
  textArea.focus();

  // Remove text area and set text node value
  textArea.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') {
      text.text(textArea.value);
      document.body.removeChild(textArea);
    }
  });
}

function boldText(text) {
  const textFontWeight = text.fontVariant();

  textFontWeight === 'normal'
    ? text.fontVariant('bold')
    : text.fontVariant('normal');
}

function deleteAllText(stage) {
  const textNodes = stage.find('Text');

  textNodes.forEach((textNode) => textNode.destroy());
}

function downloadAsJSON(stage) {
  // Generate json content
  const textNodes = stage.find('Text');
  const jsonContent = textNodes.map((textNode, index) => ({
    id: index,
    text: textNode.attrs.text,
    position: {
      x: textNode.attrs.x,
      y: textNode.attrs.y,
    },
    color: textNode.attrs.color,
    fontFamily: textNode.attrs.fontFamily,
    fontSize: textNode.attrs.fontSize,
    fontWeight: textNode.attrs.fontVariant ?? 'normal',
  }));

  // Create blob object
  const blob = new Blob([JSON.stringify(jsonContent)], { type: 'text/json' });

  // Create download link
  const dlLink = document.createElement('a');

  dlLink.href = URL.createObjectURL(blob);
  dlLink.download = 'my_text.json';
  dlLink.click();

  URL.revokeObjectURL(dlLink.href);
}

function downloadAsPDF(stage) {
  const pdf = new jsPDF('l', 'px', [stage.width(), stage.height()]);
  const textNodes = stage.find('Text');

  pdf.setTextColor('#3b3c3d');

  textNodes.forEach((text) => {
    const size = text.fontSize() / 0.75;
    pdf.setFontSize(size);
    pdf.setFontStyle(text.fontVariant());
    pdf.text(text.text(), text.x(), text.y());
  });

  pdf.save('my_text.pdf');
}
