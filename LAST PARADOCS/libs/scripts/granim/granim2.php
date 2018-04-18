<canvas id="canvas-basic"></canvas>
<script>
var granimInstance = new Granim({
element: '#canvas-basic',
name: 'basic-gradient', 
direction: 'radial',
opacity: [1, 1],
isPausedWhenNotInView: true,
states : {
"default-state": {
gradients: [
['#AA076B', '#61045F'],
['#02AAB0', '#00CDAC'],
['#DA22FF', '#9733EE']
]
}
}
});
</script>