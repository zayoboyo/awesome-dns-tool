### Totally awesome WebSupport DNS API tool

Demo: [Try the totally awesome DNS tool!](https://awesome-dns.appswing.net)

Tweak the DNS settings via WebSupport REST API with ease!

To add new DNS record:
1. Add new class to Domain\DNS\Models namespace that extends the DNSRecord class and define the bindings as an array
2. Add new record to DNSRecord::availableDNSRecords() array
3. Voila! New record is editable!