<script src="<?php echo base_url(); ?>assets/js/DataTables-2/pdfmake-0.1.32/pdfmake.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/DataTables-2/pdfmake-0.1.32/vfs_fonts.js"></script>

<script type="text/javascript">

    var dd = {
        content: [
            {
                text:'Dashboard report for: UTS Wide    |    Year: 2018     |    Period: 2 (Feb-Mar)', style:'header'
            },
            {
                text:'0 of 23 Org Units have committed data for this period.', style:'subheader'
            },
            {
                style: 'tableExample',
                table: {
                    body: [
                        ['On Track', 'Performance Improving'],
                        ['Needs Improvement', 'Performance Declining '],
                        ['Further Work Required', 'Performance Static'],
                    ]
                }
            },],
        styles: {
            header: {
                fontSize: 15,
                bold: true
            },
            subheader: {
                fontSize: 12,
                italics: true
            }
        },
        defaultStyle: {
            columnGap: 20
        }
    }
    //pdfMake.createPdf(docDefinition).download('optionalName.pdf');
    //pdfMake.createPdf(docDefinition).print();
    pdfMake.createPdf(dd).open();
</script>