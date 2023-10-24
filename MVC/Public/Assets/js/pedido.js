async function pedidoList() {
  let reposense = await fetch('http://localhost/Pasteleria-Dolce-Rivoluzione/MVC/Public/pedido/table');
  let reposenseData = await reposense.json();
  if (reposenseData.success) {
    const pedidoTableBody = document.getElementById('pedidoTableBody');
		reposenseData.result.forEach(item => {
			pedidoTableBody.insertAdjacentHTML('beforebegin',`<tr>
			<td>${item.MONTO_FINAL}</td>
			<td>${item.FECHA}</td>
			<td>${item.ESTADO}</td>
			<td>${item.METODO_PAGO}</td>
			<td>${item.ID_CLIENTE}</td>
			<td>${item.ID_EMPLEADO}</td>
			</tr>`);
		});
	}
  console.log(reposenseData);
}
pedidoList();
