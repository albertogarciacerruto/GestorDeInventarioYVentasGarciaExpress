<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
  <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
      <meta name="generator" content="PhpSpreadsheet, https://github.com/PHPOffice/PhpSpreadsheet">
      <meta name="author" content="Alberto Garcia Cerruto" />
    <style type="text/css">
      font-size: 2px;
      html { font-family:Calibri, Arial, Helvetica, sans-serif; font-size:9pt; background-color:white }
      a.comment-indicator:hover + div.comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em }
      a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em }
      div.comment { display:none }
      table { border-collapse:collapse; page-break-after:always }
      .gridlines td { border:1px dotted black }
      .gridlines th { border:1px dotted black }
      .b { text-align:center }
      .e { text-align:center }
      .f { text-align:right }
      .inlineStr { text-align:left }
      .n { text-align:right }
      .s { text-align:left }
      td.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style0 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      th.style1 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Calibri'; font-size:11pt; background-color:white }
      td.style2 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style2 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style3 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style3 { vertical-align:bottom; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style4 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style4 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style5 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style5 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style6 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style6 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style7 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style7 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style8 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:20pt; background-color:white }
      th.style8 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:20pt; background-color:white }
      td.style9 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style9 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style10 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style10 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style11 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style11 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style12 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style12 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style13 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style13 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style14 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style14 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style15 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style15 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style16 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style16 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style17 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style17 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:none #000000; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style18 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style18 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style19 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style19 { vertical-align:bottom; text-align:left; padding-left:0px; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style20 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style20 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style21 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style21 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style22 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style22 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style23 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style23 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style24 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style24 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style25 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style25 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style26 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style26 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style27 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style27 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style28 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style28 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:none #000000; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style29 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style29 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style30 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style30 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style31 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style31 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style32 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style32 { vertical-align:bottom; text-align:center; border-bottom:none #000000; border-top:none #000000; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style33 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      th.style33 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:#F2F2F2 }
      td.style34 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style34 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style35 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style35 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style36 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style36 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style37 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style37 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style38 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style38 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style39 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style39 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style40 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style40 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style41 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style41 { vertical-align:bottom; text-align:center; border-bottom:1px solid #000000 !important; border-top:2px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; font-weight:bold; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style42 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style42 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:1px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style43 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style43 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style44 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style44 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:2px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style45 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style45 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:none #000000; border-right:1px solid #000000 !important; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      td.style46 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      th.style46 { vertical-align:bottom; text-align:center; border-bottom:2px solid #000000 !important; border-top:1px solid #000000 !important; border-left:2px solid #000000 !important; border-right:none #000000; color:#000000; font-family:'Corbel Light'; font-size:11pt; background-color:white }
      table.sheet0 col.col0 { width:42pt }
      table.sheet0 col.col1 { width:47.4444439pt }
      table.sheet0 col.col2 { width:42pt }
      table.sheet0 col.col3 { width:42pt }
      table.sheet0 col.col4 { width:42pt }
      table.sheet0 col.col5 { width:42pt }
      table.sheet0 col.col6 { width:42pt }
      table.sheet0 col.col7 { width:42pt }
      table.sheet0 col.col8 { width:42pt }
      table.sheet0 col.col9 { width:42pt }
      table.sheet0 tr { height:15pt }
      table.sheet0 tr.row1 { height:25.8pt }
      table.sheet0 tr.row5 { height:15pt }
      table.sheet0 tr.row6 { height:15pt }
      table.sheet0 tr.row11 { height:15pt }
      table.sheet0 tr.row12 { height:15pt }
      table.sheet0 tr.row15 { height:15pt }
      table.sheet0 tr.row16 { height:15pt }
      table.sheet0 tr.row18 { height:15pt }
      table.sheet0 tr.row19 { height:15pt }
      table.sheet0 tr.row20 { height:15pt }
      table.sheet0 tr.row22 { height:15pt }
    </style>
  </head>

  <body>
<style>
body { margin-left: 10px; margin-right: 10px; margin-top: 10px; margin-bottom: 10px; }
</style>
    <table size="2" style="width: 100%; margin: 0 auto; position: absolute;" border="0" cellpadding="0" cellspacing="0" id="sheet0" class="sheet0 gridlines">
        <col class="col0">
        <col class="col1">
        <col class="col2">
        <col class="col3">
        <col class="col4">
        <col class="col5">
        <col class="col6">
        <col class="col7">
        <col class="col8">
        <col class="col9">
        <tbody>
          <tr class="row0">
            <td class="column0 style8 s style8" colspan="10"><img style="height: 100px;" src="images/logo.png" /></td>
          </tr>
          <tr class="row1">
            <td class="column0 style8 s style8" colspan="10">Factura </td>
          </tr>
          <tr class="row2">
            <td class="column0 style9 s style9" colspan="2">Fecha solicitud:</td>
            <td class="column2 style2 n style2" colspan="8">{{$order->date_init}}</td>
          </tr>
          <tr class="row3">
            <td class="column0 style9 s style9" colspan="2">Estatus: </td>
            @if($msj == 'pagado')
              <td class="column2 style2 s style2" colspan="8">Pagado</td>
            @elseif($msj == 'no pagado')
              <td class="column2 style2 s style2" colspan="8">Pendiente por pagar</td>
            @endif
          </tr>
          <tr class="row4">
            <td class="column0 style9 s style9" colspan="2"># Factura:</td>
            <td class="column2 style2 n style2" colspan="8">{{$order->id}}</td>
          </tr>
          <tr class="row5">
            <td class="column0 style3 null"></td>
            <td class="column1 style3 null"></td>
            <td class="column2 style3 null"></td>
            <td class="column3 style3 null"></td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style3 null"></td>
            <td class="column7 style3 null"></td>
            <td class="column8 style3 null"></td>
            <td class="column9 style3 null"></td>
          </tr>
          <tr class="row6">
            <td class="column0 style29 s style31" colspan="10">Datos del cliente</td>
          </tr>
          <tr class="row7">
            <td class="column0 style10 s style11" colspan="2">Nombre Completo:</td>
            <td class="column2 style14 s style15" colspan="8">{{$client->name}} {{$client->lastname}}</td>
          </tr>
          <tr class="row8">
            <td class="column0 style10 s style11" colspan="2">Cedula / RIF:</td>
            <td class="column2 style16 s style17" colspan="8">{{$client->identification_number}}</td>
          </tr>
          <tr class="row9">
            <td class="column0 style10 s style11" colspan="2">Correo:</td>
            <td class="column2 style16 s style17" colspan="8">{{$client->email}}</td>
          </tr>
          <tr class="row10">
            <td class="column0 style10 s style11" colspan="2">Telefono:</td>
            <td class="column2 style16 n style17" colspan="8">{{$client->phone}}</td>
          </tr>
          <tr class="row11">
            <td class="column0 style12 s style13" colspan="2">Dirección:</td>
            <td class="column2 style18 s style19" colspan="8">{{$client->address}}</td>
          </tr>

          <tr class="row12">
            <td class="column0 style3 null"></td>
            <td class="column1 style3 null"></td>
            <td class="column2 style3 null"></td>
            <td class="column3 style3 null"></td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style3 null"></td>
            <td class="column7 style3 null"></td>
            <td class="column8 style3 null"></td>
            <td class="column9 style3 null"></td>
          </tr>

          <tr class="row13">
            <td class="column0 style23 s style25" colspan="10">Pagos Registrados</td>
          </tr>
          <tr class="row14">
            <td class="column0 style34 s">Fecha</td>
          <td class="column1 style35 s style35" colspan="6">Banco/#Confirmación</td>
            <td class="column7 style35 s style36" colspan="3">Monto</td>
          </tr>
          @foreach($list_payments as $payment)
          <tr class="row15">
            <td class="column0 style7 n">{{ $payment->date }}</td>
            <td class="column1 style42 s style45" colspan="6">{{ $payment->bank }} / {{ $payment->confirmation }}</td>
            <td class="column7 style42 n style44" colspan="3">Bs. {{  number_format(($payment->amount*$order->dolar_value),2) }}</td>
          </tr>
          @endforeach

          <tr class="row12">
            <td class="column0 style3 null"></td>
            <td class="column1 style3 null"></td>
            <td class="column2 style3 null"></td>
            <td class="column3 style3 null"></td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style3 null"></td>
            <td class="column7 style3 null"></td>
            <td class="column8 style3 null"></td>
            <td class="column9 style3 null"></td>
          </tr>
          <?php $count = count($list_quotations); ?>
          @if($count > 0)
            <tr class="row13">
              <td class="column0 style23 s style25" colspan="10">Repuestos</td>
            </tr>
            <tr class="row14">
              <td class="column0 style34 s">Cantidad</td>
              <td class="column1 style35 s style35" colspan="6">Descripcion</td>
              <td class="column7 style35 s style36" colspan="3">Precio</td>
            </tr>
            @foreach($list_quotations as $quotations)
            <?php $inventory = \DB::table('inventories')->select('id','product_id')->where('id', '=', $quotations->inventory_id)->first(); ?>
            <?php $product = \DB::table('products')->select('products.id','products.name', 'products.image', 'products.amount')->where('products.id', '=', $inventory->product_id)->first(); ?>
            <tr class="row15">
              <td class="column0 style7 n">{{ $quotations->quantity }}</td>
              <td class="column1 style42 s style45" colspan="6">{{ $product->name }}</td>
              <td class="column7 style42 n style44" colspan="3">{{ number_format(($product->amount*$order->dolar_value),2) }}</td>
            </tr>
            @endforeach
          @endif
          
          <?php $conta = count($listServicios); ?>
          @if($conta > 0)
            <tr class="row16">
              <td class="column0 style29 s style31" colspan="10">Servicios</td>
            </tr>
            <tr class="row17">
              <td class="column0 style41 s style40" colspan="2">Nombre</td>
              <td class="column2 style37 s style40" colspan="5">Descripcion </td>
              <td class="column7 style37 s style39" colspan="3">Precio</td>
            </tr>
            @foreach($listServicios as $servicio)
            <?php $service = \DB::table('services')->where('id', '=', $servicio->service_id)->first(); ?>
            <tr class="row18">
              <td class="column0 style46 s style45" colspan="2">{{ $service->name }}</td>
              <td class="column2 style42 s style45" colspan="5">{{ $service->description }}</td>
              <td class="column7 style42 n style44" colspan="3">{{ number_format(($servicio->amount*$order->dolar_value),2) }}</td>
            </tr>
            @endforeach
          @endif
          <tr class="row19">
            <td class="column0 style3 null"></td>
            <td class="column1 style3 null"></td>
            <td class="column2 style3 null"></td>
            <td class="column3 style3 null"></td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style32 s">I.V.A.</td>
            <td class="column7 style4 n style6" colspan="3">Bs. {{ number_format(($order->iva*$order->dolar_value),2) }}</td>
          </tr>
          <tr class="row20">
            <td class="column0 style3 null"></td>
            <td class="column1 style3 null"></td>
            <td class="column2 style3 null"></td>
            <td class="column3 style3 null"></td>
            <td class="column4 style3 null"></td>
            <td class="column5 style3 null"></td>
            <td class="column6 style33 s">Total</td>
            <td class="column7 style20 n style22" colspan="3">Bs. {{ number_format(($order->total*$order->dolar_value),2)}}</td>
          </tr>
          <tr class="row21">
            <td class="column0 style23 s style25" colspan="10">Esta factura es valida para Automoviles Garcia Express C.A.   </td>
          </tr>
          <tr class="row22">
            <td class="column0 style26 s style28" colspan="10">conserve la misma para cualquier informacion u operación </td>
          </tr>
        </tbody>
    </table>
  </body>
</html>
