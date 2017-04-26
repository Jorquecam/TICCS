<?php
$xml = '<?xml version="1.0" encoding="utf-8"?>
<FacturaElectronicaXML xmlns="https://tribunet.hacienda.go.cr/docs/esquemas/2011/v3_1">
  <Encabezado>
    <VersionDoc>'.$verDoc.'</VersionDoc>
    <TipoDoc>'.$tipoDoc.'</TipoDoc>
    <NumConsecutivoCompr>'.$miniConsecutivo.'</NumConsecutivoCompr>
    <FechaEmisionDoc>'.$fecha.'</FechaEmisionDoc>
    <CondicionVenta>'.$condVenta.'</CondicionVenta>
    <Emisor>
      <NumCedulaEmisor>'.$cedula.'</NumCedulaEmisor>
      <NombreEmisor>'.$nombre.'</NombreEmisor>
      <NombreComercialEmisor>'.$nombre.'</NombreComercialEmisor>
      <DireccionEmisor>'.$direccion.'</DireccionEmisor>
      <NumeroAreaTelEmisor>'.$areaTel.'</NumeroAreaTelEmisor>
      <NumeroTelEmisor>'.$tel.'</NumeroTelEmisor>
      <NumeroAreaFaxEmisor>'.$areaTel.'</NumeroAreaFaxEmisor>
      <NumeroFaxEmisor>'.$fax.'</NumeroFaxEmisor>
      <CorreoElectronicoEmisor>'.$email.'</CorreoElectronicoEmisor>
    </Emisor>
    <Receptor>
      <NumCedulaReceptor>'.$cedula.'</NumCedulaReceptor>
      <NombreReceptor>'.$nombre.'</NombreReceptor>
      <DireccionReceptor>'.$direccion.'</DireccionReceptor>
      <NumeroAreaTelReceptor>'.$areaTel.'</NumeroAreaTelReceptor>
      <NumeroTelReceptor>'.$tel.'</NumeroTelReceptor>
      <NumeroTelReceptorExtranjero>0</NumeroTelReceptorExtranjero>
    </Receptor>
  </Encabezado>
  <Detalle>
    <Linea>
      <NroLinDet>'.$linea.'</NroLinDet>
      <Codigos>
        <Codigo>
          <TpoCodigo>'.$tipoCod.'</TpoCodigo>
          <VlrCodigo>VlrCodigo1</VlrCodigo>
        </Codigo>
      </Codigos>
      <Cantidad>'.$cantidad.'</Cantidad>
      <DetalleMerc>'.$codCurso.'-'.$nomCurso.'</DetalleMerc>
      <PrecioUnitario>'.$precio.'</PrecioUnitario>
      <MontoTotal>'.$precio * $cantidad * (1 + $impVentas).'</MontoTotal>
      <SubTotal>'.$precio * $cantidad.'</SubTotal>
      <Impuestos>
        <Impuesto>
          <CodigoImpuesto>1</CodigoImpuesto>
          <TarifaImpuesto>'.$impVentas.'</TarifaImpuesto>
          <MontoImpuesto>'.$impVentas * $precio.'</MontoImpuesto>
        </Impuesto>
      </Impuestos>
    </Linea>
  </Detalle>
  <TotalesFactura>
    <Moneda>'.$moneda.'</Moneda>
    <tipoCambio>'.$tipoCambio.'</tipoCambio>
    <TotalSerGravados>0</TotalSerGravados>
    <TotalSerExentos>0</TotalSerExentos>
    <TotalMerGravadas>1</TotalMerGravadas>
    <TotalMerExentas>0</TotalMerExentas>
    <TotalGravado>1</TotalGravado>
    <TotalExento>0</TotalExento>
    <TotalVenta>1</TotalVenta>
    <Descuentos>0</Descuentos>
    <TotalVentaNeta>1</TotalVentaNeta>
    <MontoImpConsumo>0</MontoImpConsumo>
    <MontoOtrosImp>0</MontoOtrosImp>
    <TarifaImpuesto>0</TarifaImpuesto>
    <MontoImpVentas>'.($impVentas + 1) * $precio.'</MontoImpVentas>
    <TotalFactura>'.$precio * $cantidad * (1 + $impVentas).'</TotalFactura>
  </TotalesFactura>
  <Autorizacion NumResolucion="31" FechaResolución="2016-10-14T00:00:00" />
  <FirmaDigital>
    <firma>Null</firma>
    <x509Certificado>Null</x509Certificado>
  </FirmaDigital>
</FacturaElectronicaXML>';
echo $xml;