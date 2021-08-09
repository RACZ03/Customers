export default class Evaluation {

    constructor(idCandidate, startDate, endDate, score = 0, bond = 0) {
        this.idCandidate = idCandidate;
        this.startDate = startDate;
        this.endDate = endDate;
        this.score = score;
        this.bond = bond;
    }

}