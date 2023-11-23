describe('GET /api/pokemon', () => {
  it('Gets a list of all pokemon', () => {
    cy.request('GET', 'http://127.0.0.1:8000/api/pokemon').then((response) => {
      expect(response.status).to.eq(200)
      expect(response).to.have.property('headers')
      expect(response).to.have.property('duration')
    })
  })

    it('Makes sure first Pokemon is "Bulbasaur"', () => {
        cy.request('GET', 'http://127.0.0.1:8000/api/pokemon').then((response) => {
         expect(response.body.data[0].name).to.eq('bulbasaur')
        })
    })
})
